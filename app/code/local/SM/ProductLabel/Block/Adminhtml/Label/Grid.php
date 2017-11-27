<?php

class SM_ProductLabel_Block_Adminhtml_Label_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set default value
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('LabelGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }


    protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }


    protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header' => Mage::helper('core')->__(' Id'),
                'index' => 'id'
            )
        );

        $this->addColumn('name',
            array(
                'header' => Mage::helper('core')->__(' Name'),
                'index' => 'name',
                'type'    => 'text'
            )
        );

        $this->addColumn('image',
            array(
                'header' => Mage::helper('core')->__(' image'),
                'index' => 'link',
                'type'    => 'text',
                'renderer' => 'SM_Slider_Block_Adminhtml_Image_Renderer_GridImage',
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