<?php
class Hienth_MegaMenu_Block_Adminhtml_Menu extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_menu';
        $this->_blockGroup      = 'Hienth_MegaMenu';
        $this->_headerText      = Mage::helper('Hienth_MegaMenu')->__('Manager Menu');
        $this->_addButtonLabel  = Mage::helper('Hienth_MegaMenu')->__('Add New Menu');
        parent::__construct();
    }
}