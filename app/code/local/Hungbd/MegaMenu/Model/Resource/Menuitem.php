<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 16:50
 */
class Hungbd_MegaMenu_Model_Resource_Menuitem extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('hungbd_megamenu/menuitem','id');
    }
}
