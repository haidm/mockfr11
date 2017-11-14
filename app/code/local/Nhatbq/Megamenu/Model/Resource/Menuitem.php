<?php 
/**
* 
*/
class Nhatbq_MegaMenu_Model_Resource_Menuitem extends Mage_Core_Model_Resource_Db_Abstract
{
	
	protected function _construct()
    {
        $this->_init('nhatbq_megamenu/menuitem','id');
    }
}