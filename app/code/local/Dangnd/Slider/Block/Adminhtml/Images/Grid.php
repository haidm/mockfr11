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
        $collection->getSelect()
            ->join(array('s' => 'mock_slider_slide'),
                'main_table.slideId = s.id',
                array(
                    'slideName' => 's.name',
                ));
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
            'renderer' => 'dangnd_slider/adminhtml_images_renderer_image'
        ));
        $this->addColumn('slideName', array(
            'header' => Mage::helper('dangnd_slider')->__('Slide'),
            'index'  => 'slideName',
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
        $this->addColumn('visible', array(
            'header' => Mage::helper('dangnd_slider')->__('Is Visible'),
            'index'  => 'visible',
            'type'      => 'options',
            'options'   => array('1' => 'Yes', '0' => 'No')
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('imageId');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('dangnd_slider')->__('Delete'),
            'url'  => $this->getUrl('*/*/multiDelete'),
            'confirm' => Mage::helper('dangnd_slider')->__('Are you sure?')
        ));

        return $this;
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