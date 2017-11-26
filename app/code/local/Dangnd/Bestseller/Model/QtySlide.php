<?php
/**
 * User: nddang196
 * Date: 26-11-2017
 * Time: 8:50 SA
 */

class Dangnd_Bestseller_Model_QtySlide extends Mage_Core_Model_Config_Data
{
    public function save()
    {
        $value = $this->getValue();
        if (!preg_match('/^[0-9]+$/', $value)) {
            Mage::throwException('The number of products must be a number');
        }
        if ($value < 3) {
            Mage::throwException('The number of products in slider must be ≥ 3');
        }
        if ($value > 7) {
            Mage::throwException('The output products in slider must be ≤ 7');
        }

        return parent::save();
    }
}