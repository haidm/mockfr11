<?php
/**
 * User: nddang
 * Date: 01-11-2017
 * Time: 4:03 CH
 */

class Dangnd_Slider_Block_Adminhtml_Helper_Image extends Varien_Data_Form_Element_Image
{
    public function getHtmlAttributes()
    {
        return array_merge(parent::getHtmlAttributes(), array('multiple'));
    }
}