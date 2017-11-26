<?php
/**
 * User: nddang196
 * Date: 22-11-2017
 * Time: 10:38 SA
 */
class Dangnd_Filter_Block_Layer_View extends Mage_Core_Block_Template
{
    /**
     * State block name
     *
     * @var string
     */
    protected $_stateBlockName;

    /**
     * Category Block Name
     *
     * @var string
     */
    protected $_categoryBlockName;

    /**
     * Attribute Filter Block Name
     *
     * @var string
     */
    protected $_attributeFilterBlockName;

    /**
     * Price Filter Block Name
     *
     * @var string
     */
    protected $_priceFilterBlockName;

    /**
     * Decimal Filter Block Name
     *
     * @var string
     */
    protected $_decimalFilterBlockName;

    /**
     * Internal constructor
     */
    protected function _construct()
    {
        parent::_construct();

        $this->_initBlocks();
    }

    /**
     * Initialize blocks names
     */
    protected function _initBlocks()
    {
        $this->_stateBlockName              = 'dangnd_filter/layer_state';
        $this->_categoryBlockName           = 'dangnd_filter/layer_filter_category';
        $this->_attributeFilterBlockName    = 'dangnd_filter/layer_filter_attribute';
        $this->_priceFilterBlockName        = 'dangnd_filter/layer_filter_price';
        $this->_decimalFilterBlockName      = 'dangnd_filter/layer_filter_decimal';
    }

    /**
     * Get attribute filter block name
     *
     * @deprecated after 1.4.1.0
     *
     * @return string
     */
    protected function _getAttributeFilterBlockName()
    {
        return 'dangnd_filter/layer_filter_attribute';
    }

    /**
     * Prepare child blocks
     *
     * @return Dangnd_Filter_Block_Layer_View
     */
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

            $this->setChild($attribute->getAttributeCode() . '_filter',
                $this->getLayout()->createBlock($filterBlockName)
                    ->setLayer($this->getLayer())
                    ->setAttributeModel($attribute)
                    ->init());
        }

        $this->getLayer()->apply();

        return parent::_prepareLayout();
    }

    /**
     * Get layer object
     *
     * @return Mage_Catalog_Model_Layer
     */
    public function getLayer()
    {
        return Mage::getSingleton('catalog/layer');
    }

    /**
     * Get all fiterable attributes of current category
     *
     * @return array
     */
    protected function _getFilterableAttributes()
    {
        $attributes = $this->getData('_filterable_attributes');
        if (is_null($attributes)) {
            $attributes = $this->getLayer()->getFilterableAttributes();
            $this->setData('_filterable_attributes', $attributes);
        }

        return $attributes;
    }

    /**
     * Get layered navigation state html
     *
     * @return string
     */
    public function getStateHtml()
    {
        return $this->getChildHtml('layer_state');
    }

    /**
     * Get all layer filters
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = array();
        if ($categoryFilter = $this->_getCategoryFilter()) {
            $filters[] = $categoryFilter;
        }

        $filterableAttributes = $this->_getFilterableAttributes();
        foreach ($filterableAttributes as $attribute) {
            $filters[] = $this->getChild($attribute->getAttributeCode() . '_filter');
        }

        return $filters;
    }

    /**
     * Get category filter block
     *
     * @return Dangnd_Filter_Block_Layer_Filter_Category
     */
    protected function _getCategoryFilter()
    {
        return $this->getChild('category_filter');
    }

    /**
     * Check availability display layer options
     *
     * @return bool
     */
    public function canShowOptions()
    {
        foreach ($this->getFilters() as $filter) {
            if ($filter->getItemsCount()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check availability display layer block
     *
     * @return bool
     */
    public function canShowBlock()
    {
        return $this->canShowOptions() || count($this->getLayer()->getState()->getFilters());
    }

    /**
     * Retrieve Price Filter block
     *
     * @return Dangnd_Filter_Block_Layer_Filter_Price
     */
    protected function _getPriceFilter()
    {
        return $this->getChild('_price_filter');
    }

    /**
     * Get url for 'Clear All' link
     *
     * @return string
     */
    public function getClearUrl()
    {
        return $this->getChild('layer_state')->getClearUrl();
    }
}
