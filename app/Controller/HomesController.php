<?php
class HomesController extends AppController {
	public $uses = array();

	public function display(){
        parent::init();
        $this->loadModel('News');
        $this->loadModel('Category');
        $news = $this->News->find('all', array(
            'order' => 'News.date DESC',
        ));

        if($news){
           $i = 0;
            foreach($news as $new){
                $catSlug = parent::get_slug($new['Category']['category']);
                $news[$i]['Category']['slug'] = $catSlug;
                $i++;
            }
            $this->set('news', $news);
        }else{
            throw new NotFoundException(__('Invalid news'));
        }
	}

    public function view(){
        parent::init();
        $slug = $this->params['url']['slug'];
        $news = $this->News->find('first', array(
            'conditions' => array('News.slug' => $slug)
        ));
        if($news){
            $this->set('news', $news);
        }else{
            throw new NotFoundException(__('Invalid slug'));
        }
    }
}
