<?php
class Hienth_Bestseller_Block_Bestseller extends Mage_Core_Block_Template
{
    public function getBestsellerHome()
    {
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addAttributeToSelect('*')
            ;
        $collection->getSelect()
            ->joinInner(
                array('order_item' => $collection->getResource()->getTable('sales/order_item')),
                "e.entity_id = order_item.product_id",
                array('SUM(order_item.qty_ordered) AS ordered_quantity',
                      'order_item.order_id AS ordered_id'
                     ))
            ->group('e.entity_id')
            ->joinInner(
                array('order' => $collection->getResource()->getTable('sales/order')),
                "order.entity_id = order_item.order_id AND order.status = 'complete'",
                array())
            ->order('ordered_quantity DESC');

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        return $collection;
    }
    public function getBestsellerCategory()
    {
        $categoryId = Mage::registry('current_category')->getId();
        $category = Mage::registry('current_category')->load($categoryId);
        $collection = Mage::getResourceModel('reports/product_collection')
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addAttributeToSelect('*')
            ->addCategoryFilter($category);
        $collection->getSelect()
            ->joinInner(
                array('order_item' => $collection->getResource()->getTable('sales/order_item')),
                "e.entity_id = order_item.product_id",
                array('SUM(order_item.qty_ordered) AS ordered_quantity',
                    'order_item.order_id AS ordered_id'
                ))
            ->group('e.entity_id')
            ->joinInner(
                array('order' => $collection->getResource()->getTable('sales/order')),
                "order.entity_id = order_item.order_id AND order.status = 'complete'",
                array())
            ->order('ordered_quantity DESC');

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        return $collection;
    }
}