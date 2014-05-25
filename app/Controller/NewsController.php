<?php

/**
 * Created by PhpStorm.
 * User: daobv
 * Date: 5/18/14
 * Time: 1:45 AM
 */
class NewsController extends AppController
{
    public $components = array('Paginator');

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'News.id' => 'desc'
        )
    );
    public $helpers = array('Html', 'Form');

    public function beforeFilter()
    {
        parent::beforeFilter();
        // Controller spesific beforeFilter
    }
    public function admin_index() {

        $title_for_layout = 'News Management';
        $this->set(compact('title_for_layout'));
        $this->Paginator->settings = $this->paginate;
        $this->loadModel('News');
        $news = $this->Paginator->paginate('News');
        $this->set(compact('title_for_layout'));
        $this->set('news', $news);
        $this->set('paginator', $this->Paginator);
    }
    public function admin_login() {
        $title_for_layout = 'Administrator login';
        $this->set(compact('title_for_layout'));
    }
    public function admin_save() {

        $title_for_layout = 'News Management';
        $this->loadModel('News');
        $this->loadModel('Category');
        $categories = $this->Category->find('all', array(
        ));
        $news = $this->News->create();
        if($this->params['pass']){
            $id = $this->params['pass'][0];
            $news = $this->News->find('first', array(
                'conditions' => array('News.id' => $id),
            ));
            $this->set('news', $news);
        }
        if ($this->request->is('post')) {
            if($this->params['pass']){
                $id = $this->params['pass'][0];
                $this->News->read(null, $id);
                $this->request->data['date'] = time();
                $this->News->set($this->request->data);
                $this->News->save();
                $this->Session->setFlash('News was updated successfully..!');
                $this->redirect('index');
            }else{
                $this->News->create();
                $this->request->data['date'] = time();
                $this->News->save($this->request->data);
                $this->Session->setFlash('Post was saved successfully..!');

                $this->redirect('index');
            }
        }
        $this->set('news', $news);
        $this->set('categories', $categories);
    }
    public function pull()
    {
        $this->loadModel('News');
        $this->loadModel('Category');
        $this->loadModel('Tags');
        $this->loadModel('Tags_meta');
        $rss = new DOMDocument();
        $rss_url = 'http://vnexpress.net/rss/';
        $category = array(
            'thoi-su',
            'doi-song',
            'the-gioi',
            'kinh-doanh',
            'giai-tri',
            'the-thao',
            'phap-luat',
            'du-lich',
            'khoa-hoc',
            'so-hoa',
        );
        foreach ($category as $rss_slug) {
            $rss->load($rss_url . $rss_slug . '.rss');
            foreach ($rss->getElementsByTagName('item') as $node) {
                $item_news = array(
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                    'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                    'date' => strtotime($node->getElementsByTagName('pubDate')->item(0)->nodeValue),
                );
                $slug = parent::get_slug($item_news['title']);
                $news = $this->News->find('first', array(
                    'conditions' => array('News.slug' => $slug)
                ));
                if (!$news) {
                    $file = parent::get_content_by_url($item_news['link']);
                    $file = str_replace('<div class="txt_tag">Tags</div>', '', $file);
                    $contents = parent::get_content_by_tag($file, '<div class="fck_detail width_common">'); //TODO cần xem lại hàm này
                    if ($contents == '') {
                        $contents = parent::get_content_by_tag($file, '<div id="article_content">');
                    }
                    $item_news['desc'] = parent::fix_desc($item_news['desc'], $item_news['link'], $slug);
                    $item_news['category'] = $this->Category->get_catid_by_slug($rss_slug);
                    $item_news['slug'] = $slug;
                    $item_news['content'] = parent::fix_content($contents);
                    $item_news['picture'] = parent::get_picture(parent::get_content_by_tag($item_news['desc'], '<a href="news/view?slug=' . $slug . '">'));
                    $item_news['desc'] = parent::remove_picture_in_desc($item_news['desc'], $slug, $item_news['picture']);
                    if ($item_news['picture'] != '' && $item_news['content'] != '' && $item_news['desc'] != '') {
                        $this->News->create();
                        $this->News->save($item_news);
                        $item_tags_meta['news'] = $this->News->getInsertID();
                        $tag_content = parent::get_content_by_tag($file, '<div class="block_tag width_common space_bottom_20">');
                        $tags = parent::get_tag_by_content($tag_content);
                        foreach ($tags as $tag) {
                            if (!$this->Tags->is_existed_tag($tag)) {
                                $this->Tags->create();
                                $item_tags['tags'] = $tag;
                                $item_tags['slug'] = parent::get_slug($tag);
                                $this->Tags->save($item_tags);
                                $item_tags_meta['tags'] = $this->Tags->getInsertID();
                            } else {
                                $item_tags_meta['tags'] = $this->Tags->get_existed_tag_id($tag);
                            }
                            $this->Tags_meta->create();
                            $this->Tags_meta->save($item_tags_meta);
                        }
                    }
                }
            }
        }
    }

    public function view()
    {
        parent::init();
        $this->loadModel('News');
        $this->loadModel('Tags_meta');
        $slug = $this->params['slug'];
        $new = $this->News->find('first', array(
            'conditions' => array('News.slug' => $slug)
        ));
        $tags = $this->Tags_meta->find('all', array(
            'conditions' => array('Tags_meta.news' => $new['News']['id'])
        ));
        $suggested = $this->News->find('all', array(
            'conditions' => array('News.id IN' => parent::getSuggest($new))
        ));
        $related = $this->News->find('all', array(
            'conditions' => array('News.id IN' => parent::getRelate($new))
        ));
        if ($new) {
            $this->set('new', $new);
            $this->set('slug', $new['Category']['slug']);
            $this->set('tags', $tags);
            $this->set('related', $related);
            $this->set('suggested', $suggested);
        } else {
            throw new NotFoundException(__('Invalid slug'));
        }
    }
}