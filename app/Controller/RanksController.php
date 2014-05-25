<?php 
Class RanksController extends AppController{
    public $name = "Ranks";
    
    public function getRelated(){
		$startTime = microtime(true);
        $this->loadModel('News');
        $this->loadModel('Tags');
        $this->loadModel('Tags_meta');
        $id = $this->request->query['id'];
        $item = $this->News->find('first', array(
			'fields' => array('News.id','News.title','News.desc', 'News.date'),
			'conditions' => array(
                'News.id' => $id
            ),
        ));
		$time = time();
		$news = $this->News->find('all', array(
			'order' => 'News.date DESC',
			'limit' => 20,
			'conditions' => array(
				'News.id !=' => $item['News']['id'],
				'News.date >' => ($item['News']['date'] - 604800),
				'News.date <' => $time,
			),
		));
		if($item['News']['date'] < ($time - 604800)){
			$news = $this->News->find('all', array(
				'order' => 'News.date DESC',
				'limit' => 20,
				'conditions' => array(
					'News.id !=' => $item['News']['id'],
					'News.date >' => ($item['News']['date'] - 302400),
					'News.date <' => ($item['News']['date'] + 302400),
				),
			));
		}
        $items[0]['id'] = $item['News']['id'];
        $items[0]['title_desc_tags'] = $item['News']['title'].' '.$item['News']['desc'];
        $key = 0;
		foreach($news as $new){
            $tags = $this->Tags_meta->find('all', array(
                'conditions' => array('Tags_meta.news' => $new['News']['id'])
            ));
            $items[$key+1]['id'] = $new['News']['id'];
            $items[$key+1]['title_desc_tags'] = $new['News']['title'].' '.$new['News']['desc'];
			foreach($tags as $tag){
				$items[$key+1]['title_desc_tags'] .= ' '.$tag['Tags']['tags'];
			}
			$key++;
        }
		//trả về mảng gồm 5 tin tức giống nhất
		echo 'Bài viết gốc:';
		pr($item);
		exit();
    }
    
    public function parsesToken($items){
		$arr = array();
        $item = explode(" ", $items);
		foreach($item as $key => $word){
			$arr[$key][0] = $word;
			$arr[$key][1] = strpos($items, $word);
		}
        return $arr;
    }
    
    public function getWord($items, $type){
        $words = array();
        foreach($items as $item){
			$word = explode(" ", $item[$type]);
			$words = array_unique(array_merge($words, $word));
        }
        return $words;
    }

    public function tfCaculator($items, $token){
        $totalTerm = $this->parsesToken($items);
        $count = 0;
        for($i=0;$i<count($totalTerm);$i++){
            $s = $totalTerm[$i][0];
            if($s == $token){
                $count++;
            }
        }
        return $count/count($totalTerm);
    }
    
    public function idfCaclator($items, $token, $type){
        $count = 0;
        foreach($items as $item){
            $item = $this->parsesToken($item[$type]);
            foreach($item as $word){
                if($word[0] == $token){
                    $count++;
                    break;
                }
            }
        }
        if($count > 0){
            return log(count($items)/$count);
        }
        else{
            return 0;
        }
    }
    
    public function tfIdfCaculator($items, $type){
        $allToken = $this->getWord($items, $type);
        foreach($items as $item){
            $count = 0;
            foreach($allToken as $token){
                $tf = $this->tfCaculator($item[$type],$token);
                $idf = $this->idfCaclator($items, $token, $type);
                $tfidf = $tf * $idf;
                $tfidfArray[$count] = $tfidf;
                $count++; 
            }
            $tfidfVector[] = $tfidfArray;
        }
        return $tfidfVector;
    }

    public function cosineSimilarity($docVector1 , $docVector2){
        $dotProduct = 0.0;
        $magnitude1 = 0.0;
        $magnitude2 = 0.0;
        $cosineSimilarity = 0.0;
        
        for($i = 0 ; $i < count($docVector1) ; $i++){
            $dotProduct += $docVector1[$i] * $docVector2[$i];
            $magnitude1 += pow($docVector1[$i],2);
            $magnitude2 += pow($docVector2[$i],2);
        }
        $magnitude1 = sqrt($magnitude1);
        $magnitude2 = sqrt($magnitude2);
        
        if($magnitude1 != 0.0 && $magnitude2 != 0.0){
            $cosineSimilarity = $dotProduct/($magnitude1*$magnitude2);
        }
        else{
            return 0.0;
        }
        return $cosineSimilarity;
    }
    
    public function getCosine2($cosineSimilary){
        $item = array();
        for($i = 1; $i < count($cosineSimilary); $i++){
            $cos = $this->cosineSimilarity($cosineSimilary[0],$cosineSimilary[$i]);
            array_push($item, $cos);
        }
        return $item;
    }

    public function getCosine($items, $type){
		$cosineSimilary = $this->tfIdfCaculator($items, $type);
        $item = array();
        for($i = 1; $i < count($cosineSimilary); $i++){
            $cos = $this->cosineSimilarity($cosineSimilary[0],$cosineSimilary[$i]);
            $item[$i] = array($items[$i]['id'],$cos);
        }
        return $item;
    }

    public function getFifth($item){
        $temp = 0;
        for($i = 1;$i < count($item); $i++){
            for($j = ($i+1);$j <= count($item); $j++){
                if($item[$i][1] < $item[$j][1]){
					$temp = $item[$i];
					$item[$i] = $item[$j];
					$item[$j] = $temp;
                }
            }
        }
        return array_slice($item, 0, 5, true);
    }
}
