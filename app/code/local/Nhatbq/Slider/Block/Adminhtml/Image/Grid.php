<?php 
/**
* 
*/
class Nhatbq_Slider_Block_Adminhtml_Image_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	
	 public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('SliderGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
    /**
     * Prepare grid collection
     *
     * @return Hungbd_Slider_Block_Adminhtml_Image_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('nhatbq_slider/image')
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
                'renderer' => 'Nhatbq_Slider_Block_Adminhtml_Image_Renderer_GridImage',
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