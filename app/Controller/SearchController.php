<?php
class SearchController extends AppController{
    public function index(){
        parent::init();
        $this->loadModel('News');
        $search = $this->request->query['s'];
		$news = $this->News->find('all', array(
			'order' => 'News.date DESC',
			'limit' => '20',
			'conditions' => array(
				'News.title LIKE' => '%'.$search.'%',
				),
			
		));
        $this->set('news', $news);
    }
}