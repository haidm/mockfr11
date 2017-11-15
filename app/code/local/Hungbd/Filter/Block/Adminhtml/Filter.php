<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 13/11/2017
 * Time: 15:59
 */
/**
 * Filter block
 * @category    Hungbd
 * @package     Hungbd_Filter_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Filter_Block_Adminhtml_Filter extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_filter';
        $this->_blockGroup      = 'hungbd_filter';
        $this->_headerText      = Mage::helper('tax')->__('Manage Filter');
        parent::__construct();
        $this->_removeButton('add');
    }
}