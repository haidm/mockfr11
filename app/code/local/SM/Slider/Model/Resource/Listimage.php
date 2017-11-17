<?php

class SM_Slider_Model_Resource_Listimage extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('sm_slider/listimage','id');
    }
}