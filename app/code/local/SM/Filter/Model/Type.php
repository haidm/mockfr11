<?php

class Hungbd_Filter_Model_Type
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'checkbox',
                'label' => 'Check Box',
            ),
            array(
                'value' => 'link',
                'label' => 'Link',
            ),
            array(
                'value' => 'color',
                'label' => 'Color',
            ),
            array(
                'value' => 'select',
                'label' => 'Select',
            )
        );
    }
}