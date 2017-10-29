<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 17:04
 */
/**
 * Menu item block
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Block_Adminhtml_Menuitem extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller      = 'adminhtml_menuitem';
        $this->_blockGroup      = 'hungbd_megamenu';
        $this->_headerText      = Mage::helper('tax')->__('Manage Menu Item');
        $this->_addButtonLabel  = Mage::helper('tax')->__('Add Menu Item');
        parent::__construct();
    }
}