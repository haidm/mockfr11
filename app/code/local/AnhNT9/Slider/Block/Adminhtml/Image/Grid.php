<?php

class AnhNT9_Slider_Block_Adminhtml_Image_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set default value
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('image_id');
        $this->setId('imageGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare grid collection
     *
     * @return AnhNT9_Slider_Block_Adminhtml_Image_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('anhnt9_slider/image')
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
        $this->addColumn('image_id',
            array(
                'header' => Mage::helper('anhnt9_slider')->__('Image ID'),
                'width' => '100px',
                'index' => 'image_id',
                'align' => 'center',
            )
        );

        $this->addColumn('sl_id',
            array(
                'header' => Mage::helper('anhnt9_slider')->__('Slide Type'),
                'width' => '250px',
                'index' => 'sl_id',
                'align' => 'center',
                'type' => 'options',
                'options' => Mage::getSingleton('anhnt9_slider/slider')->getOptionArray(),
            ));

        $this->addColumn('name_image',
            array(
                'header' => Mage::helper('anhnt9_slider')->__('Image Name'),
                'index' => 'name_image',
                'width' => '300px',
                'type' => 'text',
                'align' => 'center',
                'renderer' => 'anhnt9_slider/adminhtml_image_edit_renderer',
            )
        );

        $this->addColumn('description',
            array(
                'header' => Mage::helper('anhnt9_slider')->__('Description'),
                'index' => 'description',
                'type' => 'text'
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
        return $this->getUrl('*/*/edit', array('image_id' => $row->getId()));
    }
}