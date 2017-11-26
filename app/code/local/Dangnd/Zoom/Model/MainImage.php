<?php
/**
 * User: nddang196
 * Date: 25-11-2017
 * Time: 10:18 CH
 */

class Dangnd_Zoom_Model_MainImage extends Mage_Core_Model_Config_Data
{
    public function save()
    {
        $value = $this->getValue();
        if (!preg_match('/^[0-9]+$/', $value)) {
            Mage::throwException('Height and width main image must be a number');
        }
        if ($value < 200) {
            Mage::throwException('Height and width main image must be greater than 200');
        }
        if ($value > 500) {
            Mage::throwException('Height and width main image must be less than 500');
        }

        return parent::save();
    }
}