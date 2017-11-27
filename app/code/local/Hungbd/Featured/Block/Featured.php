<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 02/11/2017
 * Time: 10:48
 */

/**
 * Featured Template
 * @category    Hungbd
 * @package     Hungbd_Megamenu
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Featured_Block_Featured extends Mage_Catalog_Block_Product_Abstract
{
    public function getFeaturedProduct()
    {
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(array('*'))
            ->addFieldToFilter('visibility', array(2,3,4))
            ->addFieldToFilter('is_featured', 1);
        return $collection;
    }

    public function getFeaturedProductByCategory()
    {
        $category_id = Mage::registry('current_category')->getId();
        $category = Mage::getModel('catalog/category')->load($category_id);
        $products = Mage::getResourceModel('catalog/product_collection')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->addCategoryFilter($category)
            ->addAttributeToSelect(array('*'))
            ->addFieldToFilter('visibility', array(2,3,4))
            ->addFieldToFilter('is_featured', 1);
        return $products;
    }
}