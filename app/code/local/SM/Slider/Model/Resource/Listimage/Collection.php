<?php

class SM_Slider_Model_Resource_Listimage_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('sm_slider/listimage');
    }
}