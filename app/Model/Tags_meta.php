<?php
/**
 * Created by PhpStorm.
 * User: notte_001
 * Date: 5/19/14
 * Time: 11:25 PM
 */
class Tags_meta extends AppModel{
    var $useTable = "rs_tags_meta";
    public $name = "Tags_meta";
    var $belongsTo = array(
        'Tags' => array(
            'className'    => 'Tags',
            'conditions'   => '',
            'order'        => '',
            'dependent'    =>  true,
            'foreignKey'   => 'tags'
        ),
    );

}