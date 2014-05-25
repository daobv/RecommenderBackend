<?php
class CategoryController extends AppController {
    public $components = array('Paginator');

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Category.order' => 'asc'
        )
    );
    public function beforeFilter()
    {
        parent::beforeFilter();
        // Controller spesific beforeFilter
    }
    public function index(){
        $this->loadModel('News');
        parent::init();
        $slug = $this->params['slug'];
        $news = $this->News->find('all', array(
            'order' => 'News.date DESC',
            'conditions' => array('Category.slug' => $slug),
        ));
        $this->set('slug', $slug);
        $this->set('news', $news);
    }
    public function admin_index() {
        $this->Paginator->settings = $this->paginate;
        $title_for_layout = 'Category Management';
        $this->loadModel('Category');
        $categories = $this->Paginator->paginate('Category');
        $this->set(compact('title_for_layout'));
        $this->set('categories', $categories);
        $this->set('paginator', $this->Paginator);
    }
    public function admin_save() {

        $title_for_layout = 'Category Management';
        $this->loadModel('Category');
        $category = $this->Category->create();
        if($this->params['pass']){
            $id = $this->params['pass'][0];
            $category = $this->Category->find('first', array(
                'conditions' => array('Category.id' => $id),
            ));
            $this->set('category', $category);
        }
        if ($this->request->is('post')) {
            if($this->params['pass']){
                $id = $this->params['pass'][0];
                $this->Category->read(null, $id);
                $this->Category->set($this->request->data);
                $this->Category->save();
                $this->Session->setFlash('Category was updated');
                $this->redirect('index');
            }else{
                $this->Category->create();
                $this->Category->save($this->request->data);
                $this->Session->setFlash('Category was saved');

                $this->redirect('index');
            }
        }
        $this->set('category', $category);
    }
    public function admin_delete() {
        $this->loadModel('Category');
        $category = $this->Category->create();
        var_dump($this->params);
       /* if($this->params['pass']){
            $id = $this->params['pass'][0];
            var_dump($id);
            $category = $this->Category->find('first', array(
                'conditions' => array('Category.id' => $id),
            ));
            if($category){
                $this->Category->read(null, $id);
                $this->Category->delete();
                $this->Session->setFlash('Category was deleted successfully..!');
            }else{
                $this->Session->setFlash('Category dose  not exist..!');
            }
        }*/

    }
}