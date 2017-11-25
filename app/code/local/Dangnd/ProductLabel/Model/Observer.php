<?php
/**
 * User: nddang196
 * Date: 14-11-2017
 * Time: 10:38 SA
 */

class Dangnd_ProductLabel_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function productSaveBefore($observer)
    {
        $model = Mage::getModel('catalog/product');
        $product = $observer->getEvent()->getProduct();
        $simpleLabel = explode(',', $product->getProduct_label());
        if (empty($simpleLabel)) {
            return;
        }
        if ($product->getTypeId() == 'simple') {
            $parentId = Mage::getResourceSingleton('catalog/product_type_configurable')
                ->getParentIdsByChild($product->getId());

            if ($parentId) {
                $model->load($parentId);
                $oldLabel = explode(',', $model->getProduct_label());

                if(in_array('new', $simpleLabel) && !in_array('new', $oldLabel)){
                    $oldLabel[] = 'new';
                }
                if(in_array('sale', $simpleLabel) && !in_array('sale', $oldLabel)){
                    $oldLabel[] = 'sale';
                }
                if(in_array('promotion', $simpleLabel) && !in_array('promotion', $oldLabel)){
                    $oldLabel[] = 'promotion';
                }
                $model->setProduct_label(implode(',', $oldLabel));
                $model->save();
            }
        }
    }
}