<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 11:14 SA
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('slideGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    public function _prepareCollection()
    {
        $collection = Mage::getModel('dangnd_slider/slide')->getCollection();

        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    public function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('dangnd_slider')->__('ID'),
            'index'  => 'id',
            'width'  => '60px'
        ));
        $this->addColumn('name', array(
            'header' => Mage::helper('dangnd_slider')->__('Name'),
            'index'  => 'name',
            'type'   => 'text',
            'width'  => '200px'
        ));

        return parent::_prepareColumns();
    }

    /**
     * Return url
     *
     * @param Mage_Core_Model_Abstract $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $row->getId()
        ));
    }
}