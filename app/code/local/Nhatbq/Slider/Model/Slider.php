<?php 
/**
* 
*/
class Nhatbq_Slider_Model_Slider extends Mage_Core_Model_Abstract
{
	
	protected function _construct()
    {
        $this->_init('nhatbq_slider/slider');
    }
    public function toOptionArray()
    {
        $data = Mage::getModel('nhatbq_slider/slider')->getCollection();
        foreach ($data as $key => $item){
            $optionArray[$key]['label'] = $item->name;
            $optionArray[$key]['value'] = $item->id;
        }
        return $optionArray;
    }
}