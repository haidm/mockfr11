<?php 
/**
* 
*/
class Nhatbq_Slider_Block_Adminhtml_Silder extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	
	public function __construct()
    {
        $this->_controller      = 'adminhtml_slider';
        $this->_blockGroup      = 'nhatbq_slider';
        $this->_headerText      = Mage::helper('tax')->__('Manage Slider');
        $this->_addButtonLabel  = Mage::helper('tax')->__('Add Slider Menu');
        parent::__construct();
    }
}