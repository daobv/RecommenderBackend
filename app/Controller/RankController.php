<?php 
Class RankController extends AppController
{
    public $name = "Rank";
    
    public function index()
    {
        
        $b = array(
            0 => array("my tam hat hay nhat"),
        );
        
        
        $vector = $this->tfIdfCaculator($b);
        pr($vector);
        
        
        $cosine = $this->getCosine($vector);
        
        
        
    }
    
    
    /**
     * Tinh TF-IDF
     * 
     * */
    
    // L?y các t? thu?c 1 document cho tru?c
    public function parsesToken($document)
    {
        preg_match_all('/\S+/', $document, $allToken, PREG_OFFSET_CAPTURE);
        return $allToken[0];
        
    }
    
    // L?y các t? không trùng l?p trong t?t c? các van b?n
    public function getWord($allDocument)
    {
        foreach($allDocument as $document)
        {
            preg_match_all('/\S+/', $document[0], $allToken, PREG_OFFSET_CAPTURE);
            foreach($allToken[0] as $token)
            {
                
                $arrayToken[] = $token[0];
            }
        }
        
        $arrayToken = array_unique($arrayToken);
        
        foreach($arrayToken as $word){
            $allWord[] = $word;
        }
        
        return $allWord;
    }
    
    
    public function tfCaculator($document, $termCheck)
    {
        $totalTerm = $this->parsesToken($document);
        $count = 0;
        for($i=0;$i<count($totalTerm);$i++){
            $s = $totalTerm[$i][0];
            if($s == $termCheck){
                $count++;
            }
        }
        return $count/count($totalTerm);
    }
    
    public function idfCaclator($allDocument , $termToCheck)
    {
        $count = 0;
        foreach($allDocument as $document)
        {
            $document = $this->parsesToken($document[0]);
            foreach($document as $allTerm)
            {
                if($allTerm[0] == $termToCheck)
                {
                    $count++;
                    break;
                }
            }
        }
        return log(count($allDocument)/$count);
    }
    
    public function tfIdfCaculator($allDocument)
    {
        $allToken = $this->getWord($allDocument);
        foreach($allDocument as $document)
        {
            $count = 0;
            foreach($allToken as $token)
            {
                $tf = $this->tfCaculator($document[0],$token);
                $idf = $this->idfCaclator($allDocument,$token);
                $tfidf = $tf * $idf;
                $tfidfArray[$count] = $tfidf;
                $count++; 
            }
            $tfidfVector[] = $tfidfArray;
        }
        return $tfidfVector;
    }
    
    
    /**
     * Method to calculate cosine similarity between two documents.
     * 
     * */
    
    public function cosineSimilarity($docVector1 , $docVector2)
    {
        $dotProduct = 0.0;
        $magnitude1 = 0.0;
        $magnitude2 = 0.0;
        $cosineSimilarity = 0.0;
        
        for($i = 0 ; $i < count($docVector1) ; $i++)
        {
            $dotProduct += $docVector1[$i] * $docVector2[$i];
            $magnitude1 += pow($docVector1[$i],2);
            $magnitude2 += pow($docVector2[$i],2);
        }
        $magnitude1 = sqrt($magnitude1);
        $magnitude2 = sqrt($magnitude2);
        
        if($magnitude1 != 0.0 || $magnitude2 != 0.0)
        {
            $cosineSimilarity = $dotProduct/($magnitude1*$magnitude2);
        }
        else
        {
            return 0.0;
        }
        return $cosineSimilarity;
    }
    
    public function getCosine($cosineSimilary)
    {
        for($i =0 ; $i < count($cosineSimilary) ; $i++){
            for($j =0 ; $j < count($cosineSimilary) ; $j++){
                $cos = $this->cosineSimilarity($cosineSimilary[$i],$cosineSimilary[$j]);
                pr($cos); 
            }
        }
    }
}
?>