<?php
class Hienth_MegaMenu_Model_Resource_Menu_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('Hienth_MegaMenu/menu');
    }
}