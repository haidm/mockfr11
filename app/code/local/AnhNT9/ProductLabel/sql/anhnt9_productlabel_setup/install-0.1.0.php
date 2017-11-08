<?php
$installer = $this;

$installer->startSetup();
$product_label = array(
    'group'             => 'General',
    'attribute_set' => 'Default',
    'backend' =>'eav/entity_attribute_backend_array',
    'type'              => 'varchar',
    'label'             => 'Product Label',
    'input'             => 'multiselect',
    'class'             => '',
    'source' => '',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'option'            => array (
        'values' => array(
            '1' => 'New',
            '2' => 'Sale',
            '3' => 'Promotion',
        )
    ),
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
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'product_label', $product_label);

$installer->endSetup();



