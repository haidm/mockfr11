<?php
/**
 * User: nddang196
 * Date: 04-11-2017
 * Time: 6:01 CH
 */

class Dangnd_Bestseller_Block_Bestseller extends Mage_Catalog_Block_Product_Abstract
{
    public function getProducts()
    {
        $storeId = Mage::app()->getStore()->getId();
        $catId = empty(Mage::registry('current_category')) ? 0 : Mage::registry('current_category')->getId();
        $visibility = array(
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH
        );
        $list = Mage::getResourceModel('reports/product_collection');

        if($catId) {
            $cat = Mage::getModel('catalog/category')->load($catId);
            $list = Mage::getResourceModel('reports/product_collection')->addCategoryFilter($cat);
            $visibility[] = Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG;
        }
        $list = $this->_addProductAttributesAndPrices($list)
            ->addAttributeToFilter('visibility', $visibility)
            ->addStoreFilter($storeId)
            ->addAttributeToFilter('status', array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED));

        $list->getSelect()
            ->joinLeft(array('order_items' => $list->getResource()->getTable('sales/order_item')),
                'e.entity_id = order_items.product_id',
                array(
                    'total_order'      => 'SUM(order_items.qty_ordered)',
                    'order_items_name' => 'order_items.name',
                    'order_id'         => 'order_items.order_id',
                ))->group('e.entity_id')
            ->joinInner(array('order' => $list->getResource()->getTable('sales/order')),
                "order_items.order_id = order.entity_id AND order.status = 'complete'",
                array())
            ->order(array('total_order DESC'))
            ->limit(Mage::getStoreConfig('mybestseller/products/qty'));

        return ['category' => $catId, 'list' => $list->getItems()];
    }
}