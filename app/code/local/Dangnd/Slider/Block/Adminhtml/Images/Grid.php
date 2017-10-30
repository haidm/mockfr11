<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 09:42 SA
 */

class Dangnd_Slider_Block_Adminhtml_Images_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('imageGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    public function _prepareCollection()
    {
        $collection = Mage::getModel('dangnd_slider/images')->getCollection();

        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    public function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('dangnd_slider')->__('ID'),
            'index'  => 'id'
        ));
        $this->addColumn('image', array(
            'header' => Mage::helper('dangnd_slider')->__('Image'),
            'index'  => 'name',
            'width'   => '100',
            'renderer' => 'Dangnd_Slider_Block_Adminhtml_Template_Grid_Renderer_Image'
        ));
        $this->addColumn('slideId', array(
            'header' => Mage::helper('dangnd_slider')->__('Slide'),
            'index'  => 'slideId',
            'type'   => 'text'
        ));
        $this->addColumn('content', array(
            'header' => Mage::helper('dangnd_slider')->__('Content'),
            'index'  => 'content',
            'type'   => 'text'
        ));
        $this->addColumn('link', array(
            'header' => Mage::helper('dangnd_slider')->__('Link'),
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