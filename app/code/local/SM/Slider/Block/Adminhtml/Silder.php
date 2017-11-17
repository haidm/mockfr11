<?php

class SM_Slider_Block_Adminhtml_Silder extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_slider';
        $this->_blockGroup      = 'sm_slider';
        $this->_headerText      = Mage::helper('tax')->__('Manage Slider');
        $this->_addButtonLabel  = Mage::helper('tax')->__('Add Menu slider');
        parent::__construct();
    }
}