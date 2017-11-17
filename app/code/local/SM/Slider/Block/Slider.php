<?php

class SM_Slider_Block_Slider extends Mage_Core_Block_Template
{
    public function getListSlide()
    {
        $sliderConfig = Mage::getStoreConfig('smslider/sm_slider/slider_chose');
        $listImage = Mage::getModel('sm_slider/listimage')
            ->getCollection()
            ->join(array('image' => 'sm_slider/image'),
                'main_table.image_id=image.id',
                array('name','link','text'))
            ->addFilter('slider_id', $sliderConfig);
        return $listImage;
    }
}