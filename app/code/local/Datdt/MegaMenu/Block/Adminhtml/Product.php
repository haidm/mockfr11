<?php

class Datdt_MegaMenu_Block_Adminhtml_Product extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_product';
        $this->_blockGroup = 'datdt_megamenu';
        $this->_headerText = Mage::helper('datdt_megamenu')->__('Manage Product');
        $this->_addButtonLabel = Mage::helper('datdt_megamenu')->__('Create new');

        parent::__construct();
    }
}