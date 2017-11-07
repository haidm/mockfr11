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
        $catId = empty(Mage::registry('current_category')) ? 0 : Mage::registry('current_category')->getId();

        $list = Mage::getResourceModel('reports/product_collection');

        if($catId) {
            $cat = Mage::getModel('catalog/category')->load($catId);
            $list = Mage::getResourceModel('reports/product_collection')->addCategoryFilter($cat);
        }
        $list = $this->_addProductAttributesAndPrices($list)
            ->addAttributeToFilter('visibility', 4);

        $list->getSelect()
            ->joinInner(array('order_items' => $list->getResource()->getTable('sales/order_item')),
                'e.entity_id = order_items.product_id',
                array(
                    'ordered_qty'      => 'SUM(order_items.qty_ordered)',
                    'order_items_name' => 'order_items.name',
                    'order_id'         => 'order_items.order_id',
                ))->group('e.entity_id')
            ->joinInner(array('order' => $list->getResource()->getTable('sales/order')),
                "order_items.order_id = order.entity_id AND order.status = 'complete'",
                array())->order(array('ordered_qty DESC'))->limit(10);

        return $list->getItems();
    }
}