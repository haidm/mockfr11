<?php
/**
 * User: nddang196
 * Date: 25-11-2017
 * Time: 10:18 CH
 */

class Dangnd_Zoom_Model_Thumbnail extends Mage_Core_Model_Config_Data
{
    public function save()
    {
        $value = $this->getValue();
        if (!preg_match('/^[0-9]+$/', $value)) {
            Mage::throwException('Height and width thumbnail must be a number');
        }
        if ($value < 50) {
            Mage::throwException('Height and width thumbnail must be greater than 50');
        }
        if ($value > 100) {
            Mage::throwException('Height and width thumbnail must be less than 100');
        }

        return parent::save();
    }
}