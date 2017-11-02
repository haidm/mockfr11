<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 15:00
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->addAttribute('catalog_product', 'is_featured', array(
    'type' => 'varchar',
    'input' => 'select',
    'label' => 'Is Featured',
    'visible' => true,
    'required' => false,
    'visible_on_front' => true,
    'attribute_set' => 'Default',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'required' => false,
    'apply_to' => 'all',
    'group' => 'General',
    'source' => 'eav/entity_attribute_source_boolean',
));

$installer->endSetup();