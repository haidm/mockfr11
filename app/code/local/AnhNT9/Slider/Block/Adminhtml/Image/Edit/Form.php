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
 * Adminhtml Tax Rule Edit Form
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class AnhNT9_Slider_Block_Adminhtml_Image_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('imageForm');
        $this->setTitle(Mage::helper('anhnt9_slider')->__('Image Information'));
    }

    /**
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('imagemodel');

        $image_id = $this->getRequest()->getParam('image_id');
        $slider_id = $model->getData()['sl_id'];


        $valueDescription = $model->getData()['description'];

        $configSettings = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
            array(
                'add_widgets' => false,
                'add_variables' => false,
                'add_images' => false,
                'files_browser_window_url' => $this->getBaseUrl() . 'admin/cms_wysiwyg_images/index/',
            ));

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getData('action'),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $options = Mage::getSingleton('anhnt9_slider/slider')->getMultSelectArray();
        $name_slider = Mage::getModel('anhnt9_slider/slider')->load($slider_id)->getData('name_slider');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('anhnt9_slider')->__('Image Information')
        ));
        //Edit image
        if (isset($image_id) || $image_id != null) {
            $fieldset->addField('name_image', 'image',
                array(
                    'name' => 'name_image',
                    'label' => Mage::helper('anhnt9_slider')->__('Image'),
                    'renderer' => 'anhnt9_slider/adminhtml_image_renderer_image',
                    'note' => '(*.jpg, *.png, *.gif)',
                )
            );
            $fieldset->addField('sl_id', 'select',
                array(
                    'name' => 'sl_id[]',
                    'label' => Mage::helper('anhnt9_slider')->__('Slider'),
                    'class' => 'required-entry',
                    'required' => true,
                    'values' => $options,
                    'value' => $name_slider,
                )
            );
            // New image
        } else {
            $fieldset->addField('edit_image', 'file',
                array(
                    'name' => 'name_image',
                    'class' => 'required-entry required-file',
                    'label' => Mage::helper('anhnt9_slider')->__('Image'),
                    'required' => true,
                    'note' => '(*.jpg, *.png, *.gif)',
                )
            );
            $fieldset->addField('sl_id', 'multiselect',
                array(
                    'name' => 'sl_id[]',
                    'label' => Mage::helper('anhnt9_slider')->__('Slider'),
                    'class' => 'required-entry',
                    'required' => true,
                    'values' => $options,
                )
            );
        }

        $form->addField($this->getData('description'), 'editor', array(
            'name' => 'description',
            'style' => 'width:768px;height:200px',
            'class' => 'required-entry',
            'required' => true,
            'wysiwyg' => true,
            'config' => $configSettings,
            'value' => $valueDescription
        ));

        if ($model->getId()) {
            $fieldset->addField('image_id', 'hidden',
                array(
                    'name' => 'image_id',
                    'label' => Mage::helper('anhnt9_slider')->__('Id')
                )
            );
        }
        $form->addValues($model->getData());
        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/image/save'));
        $this->setForm($form);

        return parent::_prepareForm();
    }

    protected function _prepareLayout()
    {
        $return = parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        return $return;
    }
}
