<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 01/11/2017
 * Time: 14:59
 */
/**
 * Hungbd_Slider_Type_Model
 *
 * @category   Hungbd
 * @package    Hungbd_Slider
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Model_Type
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