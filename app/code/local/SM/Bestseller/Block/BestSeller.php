<?php

class SM_Bestseller_Block_BestSeller extends Mage_Catalog_Block_Product_Abstract
{
    public function getBestSellerProduct()
    {
        $products = Mage::getResourceModel('reports/product_collection');
        $products = $this->_addProductAttributesAndPrices($products)
            ->addAttributeToFilter('visibility',4);
        $products->getSelect()
            ->joinInner(array('order_items' => $products->getResource()->getTable('sales/order_item')),
                'e.entity_id = order_items.product_id',
                array(
                    'ordered_qty' => 'SUM(order_items.qty_ordered)',
                    'order_items_name' => 'order_items.name',
                    'order_id' => 'order_items.order_id',
                ))->group('e.entity_id')
            ->joinInner(array('order' => $products->getResource()->getTable('sales/order')),
                "order_items.order_id = order.entity_id AND order.status = 'complete'",
                array())->order(array('ordered_qty DESC'));
        return $products;
    }

    public function getBestSellerProductCategory()
    {
        $category_id = Mage::registry('current_category')->getId();
        $category = Mage::getModel('catalog/category')->load($category_id);
        $products = Mage::getResourceModel('reports/product_collection')
            ->addCategoryFilter($category);
        $products = $this->_addProductAttributesAndPrices($products)
            ->addAttributeToFilter('visibility',4);
        $products->getSelect()
            ->joinInner(array('order_items' => $products->getResource()->getTable('sales/order_item')),
                'e.entity_id = order_items.product_id',
                array(
                    'ordered_qty' => 'SUM(order_items.qty_ordered)',
                    'order_items_name' => 'order_items.name',
                    'order_id' => 'order_items.order_id',
                ))->group('e.entity_id')
            ->joinInner(array('order' => $products->getResource()->getTable('sales/order')),
                "order_items.order_id = order.entity_id AND order.status = 'complete'",
                array())->order(array('ordered_qty DESC'));
        return $products;
    }
}