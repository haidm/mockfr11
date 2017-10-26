<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 09:37 SA
 */

class Dangnd_Slider_Block_Adminhtml_Images extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller     = 'adminhtml_images';
        $this->_blockGroup     = 'dangnd_slider';
        $this->_headerText     = Mage::helper('dangnd_slider')->__('Manage Slider Images');
        $this->_addButtonLabel = Mage::helper('dangnd_slider')->__('Create New');

        parent::__construct();
    }
}