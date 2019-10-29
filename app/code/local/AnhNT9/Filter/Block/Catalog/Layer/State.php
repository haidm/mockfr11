<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/14/2017
 * Time: 2:52 PM
 */
class AnhNT9_Filter_Block_Catalog_Layer_State extends Mage_Catalog_Block_Layer_State
{
    /**
     * Initialize Layer State template
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('mytemplate/catalog/layer/state.phtml');
    }
}