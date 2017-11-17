<?php

class SM_Slider_Model_Type
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'horizontal',
                'label' => 'Horizontal',
            ),
            array(
                'value' => 'vertical',
                'label' => 'Vertical',
            )
        );
    }
}