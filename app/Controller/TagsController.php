<?php
class TagsController extends AppController{
    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 30,
        'order' => array(
            'Tag.id' => 'desc'
        )
    );
    public function beforeFilter()
    {
        parent::beforeFilter();
        // Controller spesific beforeFilter
    }
    public function index(){
        $this->loadModel('News');
        $this->loadModel('Tags_meta');
        parent::init();
        $slug = $this->params['slug'];
		$tags = $this->Tags_meta->find('all', array(
            'fields' => array('Tags_meta.news'),
            'conditions' => array('Tags.slug' => $slug),
        ));
		$news = array();
		foreach($tags as $tag){
			$new = $this->News->find('first', array(
				'order' => 'News.date DESC',
				'conditions' => array('News.id' => $tag['Tags_meta']['news']),
			));
			array_push($news, $new);
		}
        $this->set('slug', $slug);
        $this->set('news', $news);
    }
    public function admin_index() {
        $this->Paginator->settings = $this->paginate;
        $title_for_layout = 'Tags Management';
        $this->loadModel('Tags');
        $tags = $this->Paginator->paginate('Tags');
        $this->set(compact('title_for_layout'));
        $this->set('tags', $tags);
        $this->set('paginator', $this->Paginator);
    }
    public function admin_save() {
        $title_for_layout = 'Tags Management';
        $this->loadModel('Tags');
        $this->loadModel('Tags_meta');
        $category = $this->Tags->create();
        if($this->params['pass']){
            $id = $this->params['pass'][0];
            $tags = $this->Tags->find('first', array(
                'conditions' => array('Tags.id' => $id),
            ));
            $this->set('tags', $category);
        }
        if ($this->request->is('post')) {
            if($this->params['pass']){
                $id = $this->params['pass'][0];
                $this->Tags->read(null, $id);

                $this->Tags->set($this->request->data);
                $this->Tags_meta->read('tags', $id);
                $data = array('news'=>$this->request->data['news']);
                $this->Tags_meta->set($data);
                $this->Tags_meta->save();
                if($this->Tags->save() && $this->Tags_meta->save()) $this->Session->setFlash('Tags was updated');
                else $this->Session->setFlash('Tags was not updated..!');
                $this->redirect('index');
            }else{
                $this->Tags->create();
                $this->Tags->save($this->request->data);
                $this->Session->setFlash('Tags was saved');

                $this->redirect('index');
            }
        }
        $this->set('tags', $tags);
    }
}