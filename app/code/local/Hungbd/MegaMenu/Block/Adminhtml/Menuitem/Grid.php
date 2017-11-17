<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 17:05
 */
/**
 * Menu item Grid
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Block_Adminhtml_Menuitem_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set default value
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('menuitemGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare grid collection
     *
     * @return Hungbd_MegaMenu_Block_Adminhtml_Menuitem_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('hungbd_megamenu/menuitem')
            ->getCollection()->getJoinSefl();
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

        $this->addColumn('type',
            array(
                'header' => Mage::helper('core')->__('Type'),
                'index' => 'type',
                'type'    => 'text'
            )
        );

        $this->addColumn('link',
            array(
                'header' => Mage::helper('core')->__('Link'),
                'index' => 'link',
                'type'    => 'text'
            )
        );

        $this->addColumn('parent',
            array(
                'header' => Mage::helper('core')->__('Parent'),
                'index' => 'parent_name',
                'type'    => 'text'
            )
        );

        $this->addColumn('level',
        array(
            'header' => Mage::helper('core')->__('Level'),
            'index' => 'level',
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