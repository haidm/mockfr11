<?php
class Hienth_Slider_Block_Adminhtml_Image extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_image';
        $this->_blockGroup      = 'Hienth_Slider';
        $this->_headerText      = Mage::helper('Hienth_Slider')->__('Manager Image');
        $this->_addButtonLabel  = Mage::helper('Hienth_Slider')->__('Add New Image');
        parent::__construct();
    }
}