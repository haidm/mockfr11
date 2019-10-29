<?php
class AnhNT9_Slider_Model_Resource_Slider extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('anhnt9_slider/slider2', 'slider_id');
    }
}