<?php

class Datdt_MegaMenu_Model_Resource_Product extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('datdt_megamenu/product', 'id_pro');
    }
}