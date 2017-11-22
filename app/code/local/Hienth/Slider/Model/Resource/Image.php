<?php
class Hienth_Slider_Model_Resource_Image extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('Hienth_Slider/image','id');
    }
}