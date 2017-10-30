<?php
class Datdt_MegaMenu_Model_Resource_Custom_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('datdt_megamenu/custom');
    }
}