<?php
class Hienth_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set default value
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('sliderGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('Hienth_Slider/slider')
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
                'header' => Mage::helper('Hienth_Slider')->__('ID'),
                'index'  => 'id',
                'width'  => '50px',
                'align'  => 'center'
            )
        );
        $this->addColumn('name',
            array(
                'header' => Mage::helper('Hienth_Slider')->__('Name'),
                'index' => 'name',
                'type'    => 'text',
                'width'  => '300px',
                'align'  => 'center'
            )
        );
        $this->addColumn('list_image',
            array(
                'header' => Mage::helper('Hienth_Slider')->__('List Image'),
                'index' => 'list_image',
                'type'    => 'text',
                'align'  => 'center',
                'renderer' => 'Hienth_Slider_Block_Adminhtml_Slider_Renderer_Image'
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