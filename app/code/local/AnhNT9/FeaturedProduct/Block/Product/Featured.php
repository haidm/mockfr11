<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2017
 * Time: 2:00 PM
 */
class AnhNT9_FeaturedProduct_Block_Product_Featured extends Mage_Catalog_Block_Product_Abstract
{
    public function getFeaturedProducts() {
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToFilter('is_featured', array(1))
            ->addAttributeToFilter('status', array(1));
        return $products;
    }
}