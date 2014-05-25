<?php
/**
 * Created by PhpStorm.
 * User: notte_001
 * Date: 5/19/14
 * Time: 11:25 PM
 */
class Category extends AppModel{
    var $useTable = "rs_category";
    public $name = "Category";

    public function get_catid_by_slug($slug){
        $cat = $this->find('first', array(
            'conditions' => array('Category.slug' => $slug)
        ));
        return $cat['Category']['id'];
    }
    public function getCategoryByAtt($conditionArray){
        $cat = $this->find('first', array(
            'conditions' => $conditionArray
        ));
        return $cat;
    }
}