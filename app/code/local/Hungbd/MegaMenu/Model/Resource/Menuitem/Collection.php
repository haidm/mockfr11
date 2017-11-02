<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 16:52
 */
/**
 * Hungbd_MegaMenu MenuItem Collection
 *
 * @category   Hungbd
 * @package    Hungbd_MegaMenu
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Model_Resource_Menuitem_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('hungbd_megamenu/menuitem');
    }
}