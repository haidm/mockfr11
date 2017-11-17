<?php

class SM_Slider_Model_Slider extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('sm_slider/slider');
    }

    public function toOptionArray()
    {
        $data = Mage::getModel('sm_slider/slider')->getCollection();
        foreach ($data as $key => $item){
            $optionArray[$key]['label'] = $item->name;
            $optionArray[$key]['value'] = $item->id;
        }
        return $optionArray;
    }
}