<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 15:02
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$table = $installer->getTable('eav/attribute');
$installer->getConnection()
    ->addColumn($table, 'filter_type', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => null,
        'unique' => false,
        'comment' => 'This column for attribute filter'

    ));

$installer->endSetup();