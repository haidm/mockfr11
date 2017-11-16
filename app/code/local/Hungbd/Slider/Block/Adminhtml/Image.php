<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 29/10/2017
 * Time: 16:30
 */
/**
 * Image block
 * @category    Hungbd
 * @package     Hungbd_Slider_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Adminhtml_Image extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_image';
        $this->_blockGroup      = 'hungbd_slider';
        $this->_headerText      = Mage::helper('Hungbd_Slider')->__('Manage Silder Image');
        $this->_addButtonLabel  = Mage::helper('Hungbd_Slider')->__('Add Image');
        parent::__construct();
    }
}