<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 29/10/2017
 * Time: 15:51
 */
/**
 * Slider block
 * @category    Hungbd
 * @package     Hungbd_Slider_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Adminhtml_Silder extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_slider';
        $this->_blockGroup      = 'hungbd_slider';
        $this->_headerText      = Mage::helper('tax')->__('Manage Slider');
        $this->_addButtonLabel  = Mage::helper('tax')->__('Add Menu slider');
        parent::__construct();
    }
}