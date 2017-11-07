<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 11:20 AM
 */
class AnhNT9_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container

{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_slider';
        $this->_blockGroup      = 'anhnt9_slider';
        $this->_headerText      = Mage::helper('anhnt9_slider')->__('Manage Slider');
        $this->_addButtonLabel  = Mage::helper('anhnt9_slider')->__('Add New Slider');
        parent::__construct();
    }
}