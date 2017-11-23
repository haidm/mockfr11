<?php

class SM_Filter_Block_Layer_Filter_Decimal extends SM_Filter_Block_Layer_Filter_Abstract
{
    /**
     * Initialize Decimal Filter Model
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->_filterModelName = 'catalog/layer_filter_decimal';
    }

    /**
     * Prepare filter process
     *
     * @return Mage_Catalog_Block_Layer_Filter_Decimal
     */
    protected function _prepareFilter()
    {
        $this->_filter->setAttributeModel($this->getAttributeModel());
        $this->getFilterType();
        return $this;
    }
}
