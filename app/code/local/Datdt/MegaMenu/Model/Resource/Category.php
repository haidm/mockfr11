<?php

class Datdt_MegaMenu_Model_Resource_Category extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('datdt_megamenu/category', 'id_cat');
    }
}