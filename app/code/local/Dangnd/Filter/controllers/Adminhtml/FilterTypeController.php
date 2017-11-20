<?php
/**
 * User: nddang196
 * Date: 14-11-2017
 * Time: 10:19 SA
 */

class Dangnd_Filter_Adminhtml_FilterTypeController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $data = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('is_filterable', 1);
        foreach ($data as $datum) {
            echo $datum->getAttribute_code();
            echo '<br>';
        }
    }
}