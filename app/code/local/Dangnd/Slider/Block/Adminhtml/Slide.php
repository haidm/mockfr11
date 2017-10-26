<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 09:33 SA
 */

class Dangnd_Slider_Block_Adminhtml_Slide extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller     = 'adminhtml_slide';
        $this->_blockGroup     = 'dangnd_slider';
        $this->_addButtonLabel = Mage::helper('dangnd_slider')->__('Create Slide');
        $this->_headerText     = Mage::helper('dangnd_slider')->__('Manage Slide');

        parent::__construct();
    }
}