<?php  
/**
* 
*/
class Nhatbq_Slider_Block_Adminhtml_Image extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	
	public function __construct()
    {
        $this->_controller      = 'adminhtml_image';
        $this->_blockGroup      = 'nhatbq_slider';
        $this->_headerText      = Mage::helper('tax')->__('Manage Silder Image');
        $this->_addButtonLabel  = Mage::helper('tax')->__('Add Image');
        parent::__construct();
    }
}