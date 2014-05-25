<?php
/**
 * Created by PhpStorm.
 * User: notte_001
 * Date: 5/19/14
 * Time: 11:25 PM
 */
class Tags extends AppModel{
    var $useTable = "rs_tags";
    public $name = "Tags";
    var $belongsTo = array('Tags_meta' =>
        array('className'    => 'Tags_meta',
            'conditions'   => '',
            'order'        => '',
            'dependent'    =>  true,
            'foreignKey'   => 'id'
        )
    );
    public function is_existed_tag($tag){
        $check = $this->find('count', array(
                'conditions' => array('Tags.tags' => $tag)
            ));
        if($check == 0) return false;
        else return true;
    }

    public function get_existed_tag_id($tag){
        $tag = $this->find('first', array(
            'conditions' => array('Tags.tags' => $tag)
        ));
        return $tag['Tags']['id'];
    }
}