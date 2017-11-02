<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 01/11/2017
 * Time: 13:41
 */
/**
 * Mega Menu Block
 * @category    Hungbd
 * @package     Hungbd_Megamenu
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Slider extends Mage_Core_Block_Template
{
    public function getListSlide()
    {
        $sliderConfig = Mage::getStoreConfig('general/hungbd_slider/slider_chose');
        $listImage = Mage::getModel('hungbd_slider/listimage')
            ->getCollection()
            ->join(array('image' => 'hungbd_slider/image'),
                'main_table.image_id=image.id',
                array('name','link','text'))
            ->addFilter('slider_id', $sliderConfig);
        return $listImage;
    }
}