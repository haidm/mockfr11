<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 16:48
 */
/**
 * Hungbd_MegaMenu Menu item model
 *
 * @category   Hungbd
 * @package    Hungbd_MegaMenu
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Model_Menuitem extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('hungbd_megamenu/menuitem');
    }
}