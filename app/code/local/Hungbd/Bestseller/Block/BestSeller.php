<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 03/11/2017
 * Time: 16:55
 */
/**
 * Featured Template
 * @category    Hungbd
 * @package     Hungbd_Megamenu
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Bestseller_Block_BestSeller extends Mage_Catalog_Block_Product_Abstract
{
    public function getBestSellerProduct()
    {
        $order = Mage::getResourceModel('sales/order_collection')->addFieldToFilter('status','complete');
        $list = '(';
        foreach ($order as $item){
            $list .= $item->entity_id.',';
        }
        $list = rtrim($list,',');
        $list .= ')';
        $products = Mage::getResourceModel('reports/product_collection');
        $products = $this->_addProductAttributesAndPrices($products)
            ->addAttributeToFilter('visibility',4);
        $products->getSelect()
            ->joinInner(array('order_items' => $products->getResource()->getTable('sales/order_item')),
                "e.entity_id = order_items.product_id AND order_items.order_id in $list",
                array(
                    'ordered_qty' => 'SUM(order_items.qty_ordered)',
                    'order_items_name' => 'order_items.name',
                    'order_id' => 'order_items.order_id',
                ))->group('e.entity_id')->order(array('ordered_qty DESC'));
        return $products;
    }

    public function getBestSellerProductCategory()
    {
        $order = Mage::getResourceModel('sales/order_collection')->addFieldToFilter('status','complete');
        $list = '(';
        foreach ($order as $item){
            $list .= $item->entity_id.',';
        }
        $list = rtrim($list,',');
        $list .= ')';
        $category_id = Mage::registry('current_category')->getId();
        $category = Mage::getModel('catalog/category')->load($category_id);
        $products = Mage::getResourceModel('reports/product_collection')
            ->addCategoryFilter($category);
        $products = $this->_addProductAttributesAndPrices($products)
            ->addAttributeToFilter('visibility',4);
        $products->getSelect()
            ->joinInner(array('order_items' => $products->getResource()->getTable('sales/order_item')),
                "e.entity_id = order_items.product_id AND order_items.order_id in $list",
                array(
                    'ordered_qty' => 'SUM(order_items.qty_ordered)',
                    'order_items_name' => 'order_items.name',
                    'order_id' => 'order_items.order_id',
                ))->group('e.entity_id')->order(array('ordered_qty DESC'));
        return $products;
    }

    public function getCustomBestSeller()
    {
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToFilter('visibility',4)
            ->addAttributeToFilter('is_beseller',1);
        $collection = $this->_addProductAttributesAndPrices($collection);
        return $collection;
    }

    public function getCustomBestSellerCategory()
    {
        $category_id = Mage::registry('current_category')->getId();
        $category = Mage::getModel('catalog/category')->load($category_id);
        $products = Mage::getResourceModel('catalog/product_collection')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->addCategoryFilter($category);
        $products = $this->_addProductAttributesAndPrices($products)
            ->addAttributeToFilter('visibility',4)
            ->addAttributeToFilter('is_beseller', 1);
        return $products;
    }
}