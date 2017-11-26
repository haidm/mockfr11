<?php
/**
 * User: nddang196
 * Date: 26-11-2017
 * Time: 8:49 SA
 */

class Dangnd_Bestseller_Model_QtyProduct extends Mage_Core_Model_Config_Data
{
    public function save()
    {
        $value = $this->getValue();
        if (!preg_match('/^[0-9]+$/', $value)) {
            Mage::throwException('The number of products must be a number');
        }
        if ($value < 7) {
            Mage::throwException('The output products must be ≥ 7');
        }
        if ($value > 16) {
            Mage::throwException('The output products must be ≤ 16');
        }

        return parent::save();
    }
}