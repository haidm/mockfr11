<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 13/11/2017
 * Time: 15:08
 */
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