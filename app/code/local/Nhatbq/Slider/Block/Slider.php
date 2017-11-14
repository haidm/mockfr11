<?php 
/**
* 
*/
class Nhatbq__Slider_Block_Slider extends Mage_Core_Block_Template
{
	
	 public function getListSlide()
    {
        $sliderConfig = Mage::getStoreConfig('general/nhatbq_slider/slider_chose');
        $listImage = Mage::getModel('nhatbq_slider/listimage')
            ->getCollection()
            ->join(array('image' => 'nhatbq_slider/image'),
                'main_table.image_id=image.id',
                array('name','link','text'))
            ->addFilter('slider_id', $sliderConfig);
        return $listImage;
    }
}