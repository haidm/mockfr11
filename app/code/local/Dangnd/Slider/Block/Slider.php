<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 27-10-2017
 * Time: 10:02 SA
 */

class Dangnd_Slider_Block_Slider extends Mage_Core_Block_Template
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('dangnd/slider/index.phtml')
            ->setData('list', $this->getImages(Mage::getStoreConfig('myslider/slider_group/slide')));
    }

    public function getImages($slideId)
    {
        $images = Mage::getModel('dangnd_slider/images')
            ->getCollection()
            ->addFilter('slideId', $slideId)
            ->addFilter('visible', 1)
            ->toArray();

        return $images['items'];
    }
}