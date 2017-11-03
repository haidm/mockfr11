<?php
/**
 * Created by PhpStorm.
 * User: baohan-baotran
 * Date: 11/3/2017
 * Time: 10:12 AM
 */
class SM_Featured_Block_Category_View extends Mage_Catalog_Block_Category_View
{
    public function getFeaturedProductHtml()
    {
        return $this->getBlockHtml('product_featured');
    }
}