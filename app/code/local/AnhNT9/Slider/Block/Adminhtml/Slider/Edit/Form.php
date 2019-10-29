<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2017 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml anhnt9_slider Rule Edit Form
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class AnhNT9_Slider_Block_Adminhtml_Slider_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('sliderForm');
        $this->setTitle(Mage::helper('anhnt9_slider')->__('slider Information'));
    }

    /**
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model  = Mage::registry('slidermodel');
        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getData('action'),
            'method'    => 'post'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('anhnt9_slider')->__('Slider Information')
        ));


        $fieldset->addField('name_slider', 'text',
            array(
                'name'      => 'name_slider',
                'label'     => Mage::helper('anhnt9_slider')->__('Name Album'),
                'class'     => 'required-entry',
                'required'  => true,
            )
        );
//Kiểm tra nếu tồn tại id thì edit còn ko thì thêm mới
        if ($model->getId()) {
            $fieldset->addField('slider_id', 'hidden',
                array(
                    'name'      => 'slider_id',
                    'label'     => Mage::helper('anhnt9_slider')->__('Album Id')
                )
            );
        }

        $form->addValues($model->getData());
        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/slider/save'));
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
