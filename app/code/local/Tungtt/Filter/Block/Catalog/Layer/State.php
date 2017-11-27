<?php

class Tungtt_Filter_Block_Catalog_Layer_State extends Mage_Catalog_Block_Layer_State
{
    /**
     * Initialize Layer State template
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('mytemplate/filter/catalog/layer/state.phtml');
    }
}