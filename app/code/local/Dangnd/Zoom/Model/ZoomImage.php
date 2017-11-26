<?php
/**
 * User: nddang196
 * Date: 25-11-2017
 * Time: 10:18 CH
 */

class Dangnd_Zoom_Model_ZoomImage extends Mage_Core_Model_Config_Data
{
    public function save()
    {
        $value = $this->getValue();
        if (!preg_match('/^[0-9]+$/', $value)) {
            Mage::throwException('Height and width zoom image must be a number');
        }
        if ($value < 300) {
            Mage::throwException('Height and width zoom image must be greater than 300');
        }
        if ($value > 700) {
            Mage::throwException('Height and width zoom image must be less than 700');
        }

        return parent::save();
    }
}