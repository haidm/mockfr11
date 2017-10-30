<?php

class Datdt_MegaMenu_Block_Adminhtml_Category_Helper_Image extends Varien_Data_Form_Element_Image
{
    public function getHtmlAttributes()
    {
        return array_merge(parent::getHtmlAttributes(), array('multiple'));
    }
}