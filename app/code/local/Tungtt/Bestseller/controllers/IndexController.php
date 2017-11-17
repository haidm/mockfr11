<?php
//
//class Tungtt_Bestseller_IndexController extends Mage_Core_Controller_Front_Action
//{
//    public function indexAction()
//    {
//        $storeId = (int)Mage::app()->getStore()->getId();
//        $products = Mage::getResourceModel('reports/product_collection')
//            ->addAttributeToSelect(array('name', 'price', 'small_image'));
//        $products->getSelect()
//            ->joinInner(array('order_items' => $products->getResource()->getTable('sales/order_item')),
//                'e.entity_id = order_items.product_id',
//                array(
//                    'ordered_qty' => 'SUM(order_items.qty_ordered)',
//                    'order_items_name' => 'order_items.name',
//                    'order_id' => 'order_items.order_id',
//                ))->group('e.entity_id')
//            ->joinInner(array('order' => $products->getResource()->getTable('sales/order')),
//                "order_items.order_id = order.entity_id AND order.status = 'complete'",
//                array())->order(array('ordered_qty DESC'));
//    }
//
//}