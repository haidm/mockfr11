<?php
/**
 * User: nddang
 * Date: 01-11-2017
 * Time: 3:01 CH
 */

class SM_ProductLabel_Model_TypeLabel extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function toOptionArray()
    {
        $options = array();

        foreach ($this->getAllOptions() as $option) {
            $options[$option["value"]] = $option["label"];
        }
        return $options;
    }

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (is_null($this->_options)) {
            $this->_options = array(
                array(
                    "label" => Mage::helper("eav")->__("None"),
                    "value" =>  'none'
                ),

                array(
                    "label" => Mage::helper("eav")->__("New"),
                    "value" =>  'new'
                ),
                array(
                    "label" => Mage::helper("eav")->__("Sale"),
                    "value" =>  'sale'
                ),
                array(
                    "label" => Mage::helper("eav")->__("Promotion"),
                    "value" =>  'promotion'
                )

            );
        }
        return $this->_options;
    }
}