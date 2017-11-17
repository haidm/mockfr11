<?php
/* @var $installer Mage_Eav_Model_Entity_Setup */
$installer = $this;

$installer->startSetup();
$isFeatured = array(
    'group'             => 'Catalog',
    'attribute_set' => 'Default',
    'backend' =>'catalog/product_attribute_backend_boolean',
    'type'              => 'int',
    'label'             => 'Is Featured',
    'input'             => 'select',
    'class'             => '',
    'source' => 'eav/entity_attribute_source_boolean',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'default'           => '0',
    'required'          => false,
    'searchable'        => true,
    'visible_on_front'  => true,
    'apply_to'          => '',
    'used_for_sort_by'        => true,
    'used_in_product_listing' => true,
    'is_configurable' => false,
    'visible_in_advanced_search' => true,

);
$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'is_featured', $isFeatured);

$installer->endSetup();
