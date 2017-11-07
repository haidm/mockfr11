<?php

class AnhNT9_Slider_Model_Slider extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('anhnt9_slider/slider');
    }

    public function getOptionArray()
    {
        $collection = $this->getCollection();

        $options = array();
        foreach ($collection as $type) {
            $options[$type->slider_id] = Mage::helper('anhnt9_slider')->__($type['name_slider']);
        }
        return $options;

    }

    public function getMultSelectArray()
    {
        $collection = $this->getCollection();

        foreach ($collection as $type) {
            $options[] = array('value'=>$type->slider_id,'label'=>Mage::helper('anhnt9_slider')->__($type['name_slider']));
        }
        return $options;

    }
}