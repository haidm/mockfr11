<?php

class SM_Filter_Block_Layer_Filter_Attribute extends SM_Filter_Block_Layer_Filter_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->_filterModelName = 'catalog/layer_filter_attribute';

    }
    
    protected function _prepareFilter()
    {
        $this->_filter->setAttributeModel($this->getAttributeModel());
        $this->getFilterType();
        return $this;
    }
}
