<?php

class Tungtt_MegaMenu_Block_Adminhtml_Menuitem extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_menuitem';
        $this->_blockGroup      = 'tungtt_megamenu';
        $this->_headerText      = Mage::helper('core')->__('Manage Menu Item');
        $this->_addButtonLabel  = Mage::helper('core')->__('Add Menu Item');
        parent::__construct();
    }
}