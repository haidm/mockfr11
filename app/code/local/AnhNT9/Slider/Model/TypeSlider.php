<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/22/2017
 * Time: 11:28 AM
 */
class AnhNT9_Slider_Model_TypeSlider
{
    public function toOptionArray()
    {
        $option = array(
            array('value'=>'1','label'=>'Pagination'),
            array('value'=>'2','label'=>'Navigation'),
            array('value'=>'3','label'=>'Custom Pagination')
        );

        return $option;
    }
}