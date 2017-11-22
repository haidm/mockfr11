<?php
class Hienth_Slider_Block_Adminhtml_Image_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set default value
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('imageGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('Hienth_Slider/image')
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
                'index' => 'id',
                'align' => 'center',
                'width' => '50px'
            )
        );
        $this->addColumn('name',
            array(
                'header' => Mage::helper('Hienth_Slider')->__('Image'),
                'index' => 'name',
                'align' => 'center',
                'type'    => 'text',
                'renderer' => 'Hienth_Slider_Block_Adminhtml_Image_Renderer_Image'
            )
        );
        $this->addColumn('link',
            array(
                'header' => Mage::helper('Hienth_Slider')->__('Link'),
                'index' => 'link',
                'align' => 'center',
                'type'    => 'text'
            )
        );
        $this->addColumn('text',
            array(
                'header' => Mage::helper('Hienth_Slider')->__('Text'),
                'index' => 'text',
                'align' => 'center',
                'type'    => 'text'
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