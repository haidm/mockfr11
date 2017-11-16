<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 13/11/2017
 * Time: 16:00
 */
/**
 * Fitler Grid
 * @category    Hungbd
 * @package     Hungbd_Filter_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Filter_Block_Adminhtml_Filter_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set default value
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('FilterGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare grid collection
     *
     * @return Hungbd_Filter_Block_Adminhtml_Filter_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('catalog/product_attribute_collection');
        $collection
            ->addFieldToFilter('is_filterable',1)
            ->setItemObjectClass('catalog/resource_eav_attribute')
            ->setOrder('position', 'ASC');
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    /**
     * Prepare grid columns
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header' => Mage::helper('core')->__(' Id'),
                'index' => 'attribute_id'
            )
        );

        $this->addColumn('name',
            array(
                'header' => Mage::helper('core')->__(' Name'),
                'index' => 'frontend_label',
                'type'    => 'text'
            )
        );

        $this->addColumn('filter type',
            array(
                'header' => Mage::helper('core')->__(' Filter Type'),
                'index' => 'filter_type',
                'type'    => 'text',
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * Return url
     *
     * @param Mage_Core_Model_Abstract $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}