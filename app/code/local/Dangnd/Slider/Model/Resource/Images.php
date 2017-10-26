<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 10:45 SA
 */

class Dangnd_Slider_Model_Resource_Images extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('dangnd_slider/images', 'id');
    }
}