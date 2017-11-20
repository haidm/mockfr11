<?php
/**
 * User: nddang196
 * Date: 14-11-2017
 * Time: 10:38 SA
 */

class Dangnd_Filter_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function addFieldToAttributeEditForm($observer)
    {
        $filterType = array(
            array(
                'label' => 'Link',
                'value' => 'link'
            ),
            array(
                'label' => 'Select',
                'value' => 'select'
            ),
            array(
                'label' => 'Checkbox',
                'value' => 'checkbox'
            ),
            array(
                'label' => 'Color',
                'value' => 'color'
            ),
        );
        $fieldset = $observer->getForm()->getElement('base_fieldset');
        $fieldset->addField('filterType', 'select', array(
            'name'   => 'filterType',
            'label'  => Mage::helper('core')->__('Filter Type'),
            'title'  => Mage::helper('core')->__('Filter Type'),
            'values' => $filterType
        ));
    }
}