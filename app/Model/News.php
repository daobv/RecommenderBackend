<?php
/**
 * Created by PhpStorm.
 * User: daobv
 * Date: 5/18/14
 * Time: 1:44 AM
 */
class News extends AppModel{
    var $useTable = "rs_news";
    public $name = "News";
    var $belongsTo = array(
        'Category' => array(
            'className'    => 'Category',
            'conditions'   => '',
            'order'        => '',
            'dependent'    =>  true,
            'foreignKey'   => 'category'
        ),
    );
}