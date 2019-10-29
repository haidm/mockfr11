<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2017
 * Time: 2:03 PM
 */
class AnhNT9_FeaturedProduct_Block_Product_Html extends Mage_Page_Block_Html
{
    public function getFeaturedProductHtml()
    {
        return $this->getBlockHtml('product_featured');
    }
}