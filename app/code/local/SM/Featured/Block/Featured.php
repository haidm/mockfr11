<?php

class SM_Featured_Block_Featured extends Mage_Catalog_Block_Product_Abstract
{
    public function getFeaturedProduct()
    {        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToFilter('visibility',4)
            ->addAttributeToFilter('is_featured',1);
        $collection = $this->_addProductAttributesAndPrices($collection);
        return $collection;
    }

    public function getFeaturedProductByCategory()
    {
        $category_id = Mage::registry('current_category')->getId();
        $category = Mage::getModel('catalog/category')->load($category_id);
        $products = Mage::getResourceModel('catalog/product_collection')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->addCategoryFilter($category);
        $products = $this->_addProductAttributesAndPrices($products)
            ->addAttributeToFilter('visibility',4)
            ->addAttributeToFilter('is_featured', 1);
        return $products;
    }
}