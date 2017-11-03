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
        $this->setTemplate('myslider/index.phtml')
            ->setData('list', $this->getSlider());
    }

    public function getSlider()
    {
        $listSlide = Mage::getModel('dangnd_slider/slide')
            ->getCollection()
            ->toArray();
        $listSlide = $listSlide['items'];

        foreach ($listSlide as $key => $item) {
            $listSlide[$key]['images'] = $this->getImages($item['id']);
        }

        return $listSlide;
    }

    public function getImages($slideId)
    {
        $images = Mage::getModel('dangnd_slider/images')
            ->getCollection()
            ->addFilter('slideId', $slideId)
            ->toArray();

        return $images['items'];
    }
}