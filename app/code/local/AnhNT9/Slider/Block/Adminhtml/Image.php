<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 3:19 PM
 */
class AnhNT9_Slider_Block_Adminhtml_Image extends Mage_Adminhtml_Block_Widget_Grid_Container

{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_image';
        $this->_blockGroup      = 'anhnt9_slider';
        $this->_headerText      = Mage::helper('anhnt9_slider')->__('Manage Image');
        $this->_addButtonLabel  = Mage::helper('anhnt9_slider')->__('Add New Image');
        parent::__construct();
    }
}