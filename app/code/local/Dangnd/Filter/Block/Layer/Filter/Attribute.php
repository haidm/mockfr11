<?php
/**
 * User: nddang196
 * Date: 22-11-2017
 * Time: 10:38 SA
 */
class Dangnd_Filter_Block_Layer_Filter_Attribute extends Dangnd_Filter_Block_Layer_Filter_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->_filterModelName = 'catalog/layer_filter_attribute';
    }
    
    protected function _prepareFilter()
    {
        $this->_filter->setAttributeModel($this->getAttributeModel());
        $this->setTemplate($this->getTemplateName($this->_filter->getAttributeModel()->getFilterType()));
        return $this;
    }
}
