<?php

/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 03/11/2017
 * Time: 13:49
 */
class Hungbd_Bestseller_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $order = Mage::getResourceModel('sales/order_collection')->addFieldToFilter('status','complete');
        $list = '(';
        foreach ($order as $item){
            $list .= $item->entity_id.',';
        }
        $list = rtrim($list,',');
        $list .= ')';
        $storeId = (int)Mage::app()->getStore()->getId();
        $products = Mage::getResourceModel('reports/product_collection')
            ->addAttributeToSelect(array('name', 'price', 'small_image'))->addAttributeToFilter('visibility', 4);
        $products->getSelect()
            ->joinInner(array('order_items' => $products->getResource()->getTable('sales/order_item')),
                "e.entity_id = order_items.product_id AND order_items.order_id in $list",
                array(
                    'ordered_qty' => 'SUM(order_items.qty_ordered)',
                    'order_items_name' => 'order_items.name',
                    'order_id' => 'order_items.order_id',
                ))->group('e.entity_id');
        $time = 0;
        foreach ($products as $item) {
            $time++;
            echo $item->entity_id.'<br>';
//            echo $item->name.'<br>';
//            echo $item->ordered_qty.'<br>';
            echo $item->order_id.'<br>';
            echo '-------------------------------- <br>';
        }
        echo $time;
    }

}