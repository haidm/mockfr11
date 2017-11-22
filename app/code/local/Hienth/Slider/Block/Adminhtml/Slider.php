<?php
class Hienth_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_slider';
        $this->_blockGroup      = 'Hienth_Slider';
        $this->_headerText      = Mage::helper('Hienth_Slider')->__('Manager Slider');
        $this->_addButtonLabel  = Mage::helper('Hienth_Slider')->__('Add New Slider');
        parent::__construct();
    }
}