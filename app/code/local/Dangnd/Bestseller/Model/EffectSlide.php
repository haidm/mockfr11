<?php
/**
 * User: nddang
 * Date: 01-11-2017
 * Time: 3:01 CH
 */

class Dangnd_Bestseller_Model_EffectSlide
{
    public function toOptionArray()
    {
        return [
            [
                'label' => 'None',
                'value' => ''
            ],
            [
                'label' => 'Fade',
                'value' => 'fade'
            ],
            [
                'label' => 'Cube',
                'value' => 'cube'
            ],
            [
                'label' => 'Flip',
                'value' => 'flip'
            ],
            [
                'label' => 'Coverflow',
                'value' => 'coverflow'
            ]
        ];
    }
}