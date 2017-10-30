<?php
class Datdt_MegaMenu_Block_Adminhtml_Custom_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id_cus');
        $this->setId('g_custom');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    public function _prepareCollection()
    {
        $collection = Mage::getModel('datdt_megamenu/custom')->getCollection();

        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    public function _prepareColumns()
    {
        $this->addColumn('id_cus', array(
            'header' => Mage::helper('datdt_megamenu')->__('ID'),
            'index'  => 'id_cus'
        ));
        $this->addColumn('name', array(
            'header' => Mage::helper('datdt_megamenu')->__('Name'),
            'index'  => 'name',
            'type'   => 'text'
        ));
        $this->addColumn('link', array(
            'header' => Mage::helper('datdt_megamenu')->__('Link'),
            'index'  => 'link',
            'type'   => 'text'
        ));

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
        return $this->getUrl('*/*/edit', array(
            'id' => $row->getId()
        ));
    }
}