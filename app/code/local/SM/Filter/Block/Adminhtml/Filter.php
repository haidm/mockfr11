<?php

class SM_Filter_Block_Adminhtml_Filter extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_filter';
        $this->_blockGroup      = 'sm_filter';
        $this->_headerText      = Mage::helper('sm_filter')->__('Manage Filter');
        parent::__construct();
        $this->_removeButton('add');
    }
}