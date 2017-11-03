<?php
/**
 * User: nddang
 * Date: 01-11-2017
 * Time: 3:01 CH
 */

class Dangnd_Slider_Model_TypeSlider
{
    public function toOptionArray()
    {
        return [
            [
                'label' => 'Horizontal',
                'value' => 'horizontal'
            ],
            [
                'label' => 'Vertical',
                'value' => 'vertical'
            ]
        ];
    }
}