<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 29/10/2017
 * Time: 16:12
 */
/**
 * Hungbd_Slider_Slider_Model
 *
 * @category   Hungbd
 * @package    Hungbd_Slider
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Model_Slider extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('hungbd_slider/slider');
    }

    public function toOptionArray()
    {
        $data = Mage::getModel('hungbd_slider/slider')->getCollection();
        foreach ($data as $key => $item){
            $optionArray[$key]['label'] = $item->name;
            $optionArray[$key]['value'] = $item->id;
        }
        return $optionArray;
    }
}