<?php

class Tungtt_MegaMenu_Model_Resource_Menuitem_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('tungtt_megamenu/menuitem');
    }

    public function getJoinSefl()
    {
        $select = $this->getSelect();
        $select
            ->joinLeft(array('self' => 'menuitem'),
                'main_table.parent_id = self.id',
                array('self.name as parent_name'));
        return $this;
    }
}