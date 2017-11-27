<?php

class SM_ProducLabel_Block_Adminhtml_Image extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_label';
        $this->_headerText      = Mage::helper('tax')->__('Manage Label');
        $this->_addButtonLabel  = Mage::helper('tax')->__('Add Label');
        parent::__construct();
    }
}