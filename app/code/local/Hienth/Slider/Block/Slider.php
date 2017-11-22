<?php
class Hienth_Slider_Block_Slider extends Mage_Core_Block_Template
{
    public function getSlider()
    {
        $idConfig = Mage::getStoreConfig('general/Hienth_Slider/slideractive');
//        var_dump($idConfig);die;
        $listImage = Mage::getModel('Hienth_Slider/slider')->load($idConfig)->list_image;
        $arrList = explode('-',$listImage);
        $listToSlider = array();
        $modelImage = Mage::getModel('Hienth_Slider/image')->getCollection();
        foreach ($modelImage as $k => $item)
        {
            $listToSlider[$k]['text'] = $item->text;
            $listToSlider[$k]['name'] = $item->name;
            $listToSlider[$k]['link'] = $item->link;
        }
        return $listToSlider;
    }
}