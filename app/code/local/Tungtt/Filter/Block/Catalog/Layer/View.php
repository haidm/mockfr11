<?php

class Tungtt_Filter_Block_Catalog_Layer_View extends Mage_Catalog_Block_Layer_View
{
    protected function _prepareLayout()
         {
             $stateBlock = $this->getLayout()->createBlock($this->_stateBlockName)
                 ->setLayer($this->getLayer());
             $categoryBlock = $this->getLayout()->createBlock($this->_categoryBlockName)
                 ->setLayer($this->getLayer())
                 ->init();
             $this->setChild('layer_state', $stateBlock);
             $this->setChild('category_filter', $categoryBlock);
             $filterableAttributes = $this->_getFilterableAttributes();
             foreach ($filterableAttributes as $attribute) {
                 if ($attribute->getAttributeCode() == 'price') {
                     $filterBlockName = $this->_priceFilterBlockName;
                 } elseif ($attribute->getBackendType() == 'decimal') {
                     $filterBlockName = $this->_decimalFilterBlockName;
                 } else {
                     $filterBlockName = $this->_attributeFilterBlockName;
                 }
                 // This is where one of the Mage_Catalog_Block_Layer_Filter_* classes
                 // are instantiated. They all extend Mage_Catalog_Block_Layer_Filter_Abstract
                 // which means that you can call setTemplate here and redefine one that is
                 // set in abstract class. You can also set different templates based block type.
                 $this->setChild($attribute->getAttributeCode() . '_filter',
                     $this->getLayout()->createBlock($filterBlockName)
                         // Set your template here
                         ->setTemplate('mytemplate/filter/catalog/layer/filter.phtml')
                         ->setLayer($this->getLayer())
                         ->setAttributeModel($attribute)
                         ->init());
             }
             $this->getLayer()->apply();
             return $this;
         }
}