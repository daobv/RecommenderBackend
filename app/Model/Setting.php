<?php
/**
 * Created by PhpStorm.
 * User: notte_001
 * Date: 5/20/14
 * Time: 10:58 AM
 */
class Setting extends AppModel{
    var $useTable = "rs_setting";
    public $name = "Setting";

    public function get_setting($name){
        $setting = $this->find('first', array(
            'conditions' => array('Setting.name' => $name)
        ));
        return $setting['Setting']['value'];
    }
}