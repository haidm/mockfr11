<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/2/2017
 * Time: 6:08 PM
 */
class AnhNT9_Slider_Model_SliderConfig
{
    public function toOptionArray()
    {
        $option = Mage::getSingleton('anhnt9_slider/slider')->getMultSelectArray();

        return $option;
    }
}
