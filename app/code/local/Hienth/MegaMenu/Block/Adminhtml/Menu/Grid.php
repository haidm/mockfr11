<?php
class Hienth_MegaMenu_Block_Adminhtml_Menu_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set default value
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('cateGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('Hienth_MegaMenu/menu')
            ->getCollection();
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
                'header' => Mage::helper('Hienth_MegaMenu')->__('ID'),
                'index' => 'id'
            )
        );
        $this->addColumn('name',
            array(
                'header' => Mage::helper('Hienth_MegaMenu')->__('Name'),
                'index' => 'name',
                'type'    => 'text'
            )
        );
        $this->addColumn('type',
            array(
                'header' => Mage::helper('Hienth_MegaMenu')->__('Type'),
                'index' => 'type',
                'type'    => 'text'
            )
        );
        $this->addColumn('link',
            array(
                'header' => Mage::helper('Hienth_MegaMenu')->__('Link'),
                'index' => 'link',
                'type'    => 'text'
            )
        );
        $this->addColumn('level',
            array(
                'header' => Mage::helper('Hienth_MegaMenu')->__('Level'),
                'index' => 'level',
                'type'    => 'integer'
            )
        );
        $this->addColumn('parent_id',
            array(
                'header' => Mage::helper('Hienth_MegaMenu')->__('Parent ID'),
                'index' => 'parent_id',
                'type'    => 'integer'
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