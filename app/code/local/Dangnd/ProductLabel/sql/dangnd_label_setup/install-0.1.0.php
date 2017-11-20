<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 25-10-2017
 * Time: 02:24 CH
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'product_label', array(
    'group'                      => 'Design',
    'attribute_set'              => 'Default',
    'backend'                    => 'eav/entity_attribute_backend_array',
    'type'                       => 'text',
    'label'                      => 'Label',
    'input'                      => 'multiselect',
    'source'                     => 'dangnd_label/typeLabel',
    'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'                    => true,
    'default'                    => '',
    'required'                   => false,
    'searchable'                 => true,
    'visible_on_front'           => false,
    'apply_to'                   => '',
    'used_for_sort_by'           => true,
    'used_in_product_listing'    => true,
    'is_configurable'            => false,
    'visible_in_advanced_search' => true,
));

$installer->endSetup();