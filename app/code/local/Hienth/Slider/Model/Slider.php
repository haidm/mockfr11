<?php
class Hienth_Slider_Model_Slider extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
       $this->_init('Hienth_Slider/slider');
    }
    public function toOptionArray()
    {
        $data = Mage::getModel('Hienth_Slider/slider')->getCollection();
        foreach ($data as $key => $item){
            $optionArray[$key]['label'] = $item->name;
            $optionArray[$key]['value'] = $item->id;
        }
        return $optionArray;
    }
}