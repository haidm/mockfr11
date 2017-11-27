<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 22/11/2017
 * Time: 10:48
 */
class Hungbd_Featured_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(array('*'))
//            ->addFieldToFilter('visibility', array(2,3,4))
            ->addFieldToFilter('is_featured', 1);
//        var_dump($collection);
        $time = 0;
        foreach ($collection as $item){
//            var_dump($item);
            echo $item->name.'<br>';
            $time++;
        }
        echo $time;
    }
}