<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
    public $category;
	//public $components = array('DebugKit.Toolbar');
    public function beforeFilter() {
        if ((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin'))) {
            $this->layout = 'admin';
        }
    }
    protected function init(){
        $this->loadModel('Category');
        $slug = $this->params['slug'];
        $category = $this->Category->find('all', array(
            'fields' => array('Category.category', 'Category.id', 'Category.order', 'Category.slug'),
        ));
        $this->set('slug', $slug);
        if($category){
            $this->set('categories', $category);
        }else{
            throw new NotFoundException(__('Invalid slug'));
        }
    }

    protected function fix_desc($desc, $link, $slug){
        $desc = str_replace($link, 'news/view?slug='.$slug, $desc);
        return $desc;
    }

    protected function fix_content($content){
        $content = str_replace('<table align="right" border="1" cellpadding="1" cellspacing="0" class="tbl_insert" style="width:40%;"><tbody><tr><td style="background-color: rgb(204, 204, 204);">', '', $content);
        $content = str_replace('<table align="center" border="1" cellpadding="1" cellspacing="0" class="tbl_insert" style="width:100%;"><tbody><tr><td style="background-color: rgb(204, 204, 204);">', '', $content);
        $content = str_replace('<table align="center" border="0" cellpadding="2" cellspacing="0" class="tplCaption" ><tbody><tr><td style="text-align: center;">', '', $content);
        $content = str_replace('<table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" ><tbody><tr><td>', '', $content);
        $content = str_replace('<table border="0" cellpadding="3" cellspacing="0" class="tplCaption" ><tbody><tr><td>', '', $content);
        $content = str_replace('</td>', '', $content);
        $content = str_replace('</tr><tr><td>', '', $content);
        $content = str_replace('</tr></tbody></table>', '', $content);
        $content = str_replace('class="Image"', 'class="Image" align="center"', $content);
        return $content;
    }

    protected function get_picture($content){
        if($content != ''){
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($content); // loads your html
            $xpath = new DOMXPath($doc);
            $nodelist = $xpath->query("//img"); // find your image
            $node = $nodelist->item(0); // gets the 1st image
            $value = $node->attributes->getNamedItem('src')->nodeValue;
            return $value;
        }
        else{
            return '';
        }
    }

    protected function get_slug($title){
        $title = str_replace("'", "", $title);
        $title = str_replace("?", "", $title);
        $title = str_replace("!", "", $title);
        $title = str_replace(":", "", $title);
        $title = str_replace("‘", "", $title);
        $title = str_replace(".", "", $title);
        $title = str_replace("’", "", $title);
        $title = str_replace("%", "", $title);
        $title = str_replace("\\", "", $title);
        $title = str_replace(" ", "-", $title);
        $title = str_replace(",", "-", $title);
        $title = str_replace("&amp;", "-", $title);
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach($unicode as $nonUnicode=>$uni){
            $title = preg_replace("/($uni)/i", $nonUnicode, $title);
        }
        return strtolower($title);
    }

    protected static function get_content_by_url($url){
        $content = file_get_contents($url);
        do{
            $content = str_replace("  "," ",$content);
        }while(strpos($content,"  ",0)!==false);
        return $content;
    }

    protected function get_content_by_tag($content, $tag_and_more,$include_tag = true){
        $p = stripos($content,$tag_and_more,0);

        if($p===false) return "";
        $content=substr($content,$p);
        $p = stripos($content," ",0);
        if(abs($p)==0) return "";
        $open_tag = substr($content,0,$p);
        $close_tag = substr($open_tag,0,1)."/".substr($open_tag,1).">";

        $count_inner_tag = 0;
        $p_open_inner_tag = 1;
        $p_close_inner_tag = 0;
        $count=1;
        do{
            $p_open_inner_tag = stripos($content,$open_tag,$p_open_inner_tag);
            $p_close_inner_tag = stripos($content,$close_tag,$p_close_inner_tag);
            $count++;
            if($p_close_inner_tag!==false) $p = $p_close_inner_tag;
            if($p_open_inner_tag!==false){
                if(abs($p_open_inner_tag)<abs($p_close_inner_tag)){
                    $count_inner_tag++;
                    $p_open_inner_tag++;
                }else{
                    $count_inner_tag--;
                    $p_close_inner_tag++;
                }
            }else{
                $count_inner_tag--;
                if($p_close_inner_tag>0) $p_close_inner_tag++;
            }
        }while($count_inner_tag>0);
        if($include_tag)
            return substr($content,0,$p+strlen($close_tag));
        else{
            $content = substr($content,0,$p);
            $p = stripos($content,">",0);
            return substr($content,$p+1);
        }
    }

    protected function get_tag_by_content($content){
        $xmlDoc = new DOMDocument();
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        libxml_use_internal_errors(true);
        $xmlDoc->loadHTML($content);
        libxml_use_internal_errors(false);
        $searchNodes = $xmlDoc->getElementsByTagName("a");
        $tag = array();
        foreach($searchNodes as $k => $v){
            array_push($tag, $xmlDoc->getElementsByTagName("a")->item($k)->nodeValue);//$searchNode->getAttribute('title'));
        }
        return $tag;
    }

    protected function remove_picture_in_desc($desc, $slug, $picture){
        $desc = str_replace('<a href="news/view?slug='.$slug.'">', '', $desc);
        $desc = str_replace('<img width=130 height=100 src="'.$picture.'" >', '', $desc);
        $desc = str_replace('</a>', '', $desc);
        $desc = str_replace('</br>', '', $desc);
        return $desc;
    }
	
	protected function getSuggest($item){
        $this->loadModel('News');
        $this->loadModel('Tags');
		$time = time();
        $original_new = $this->News->find('first', array(
            'conditions' => array(
                'News.id =' => $item['News']['id']
            ),
        ));
		if($item['News']['date'] > ($time - 604800)){
			$news = $this->News->find('all', array(
				'order' => 'News.date DESC',
				'limit' => 20,
				'conditions' => array(
					'News.id !=' => $item['News']['id'],
					'News.category' => $item['News']['category'],
					'News.date >' => ($item['News']['date'] - 604800),
					'News.date <' => $time,
				),
			));
		}
		else{
			$news = $this->News->find('all', array(
				'order' => 'News.date DESC',
				'limit' => 20,
				'conditions' => array(
					'News.id !=' => $item['News']['id'],
					'News.category' => $item['News']['category'],
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
		//trả về mảng gồm 4 tin tức giống nhất
		$five = $this->getForth($this->getCosine($items, 'title_desc_tags'));
		foreach($five as $one){
			$arr[] = $one[0];
		}
		return $arr;
    }
    
	protected function getRelate($item){
        $this->loadModel('News');
        $this->loadModel('Tags');
		$time = time();
        $original_new = $this->News->find('first', array(
            'conditions' => array(
                'News.id =' => $item['News']['id']
            ),
        ));
		if($item['News']['date'] > ($time - 604800)){
			$news = $this->News->find('all', array(
				'order' => 'News.date DESC',
				'limit' => 30,
				'conditions' => array(
					'News.id !=' => $item['News']['id'],
					'News.date >' => ($item['News']['date'] - 604800),
					'News.date <' => $time,
				),
			));
		}
		else{
			$news = $this->News->find('all', array(
				'limit' => 30,
				'order' => 'News.date DESC',
				'conditions' => array(
					'News.id !=' => $item['News']['id'],
					'News.date >' => ($item['News']['date'] - 302400),
					'News.date <' => ($item['News']['date'] + 302400),
				),
			));
		}
        $items[0]['id'] = $item['News']['id'];
        $items[0]['title'] = $item['News']['title'];
		$key = 0;
		foreach($news as $new){
            $items[$key+1]['id'] = $new['News']['id'];
            $items[$key+1]['title'] = $new['News']['title'];
			$key++;
        }
		//trả về mảng gồm 4 tin tức giống nhất
		$fifteen = $this->getFifteen($this->getCosine($items, 'title'));
		foreach($fifteen as $one){
			$arr[] = $one[0];
		}
		return $arr;
    }
    
    protected function parsesToken($items){
		$arr = array();
        $item = explode(" ", $items);
		foreach($item as $key => $word){
			$arr[$key][0] = $word;
			$arr[$key][1] = strpos($items, $word);
		}
        return $arr;
    }
    
    protected function getWord($items, $type){
        $words = array();
        foreach($items as $item){
			$word = explode(" ", $item[$type]);
			$words = array_unique(array_merge($words, $word));
        }
        return $words;
    }

    protected function tfCaculator($items, $token){
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
    
    protected function idfCaclator($items, $token, $type){
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
    
    protected function tfIdfCaculator($items, $type){
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

    protected function cosineSimilarity($docVector1 , $docVector2){
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
    
    protected function getCosine2($cosineSimilary){
        $item = array();
        for($i = 1; $i < count($cosineSimilary); $i++){
            $cos = $this->cosineSimilarity($cosineSimilary[0],$cosineSimilary[$i]);
            array_push($item, $cos);
        }
        return $item;
    }

    protected function getCosine($items, $type){
		$cosineSimilary = $this->tfIdfCaculator($items, $type);
        $item = array();
        for($i = 1; $i < count($cosineSimilary); $i++){
            $cos = $this->cosineSimilarity($cosineSimilary[0],$cosineSimilary[$i]);
            $item[$i] = array($items[$i]['id'],$cos);
        }
        return $item;
    }

    protected function getForth($item){
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
        return array_slice($item, 0, 4, true);
    }

    protected function getFifteen($item){
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
        return array_slice($item, 0, 15, true);
    }
}
