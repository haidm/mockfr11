<?php

$installer = $this;

$installer->startSetup();
$table = $installer->getTable('eav/attribute');
$installer->getConnection()
    ->addColumn($table, 'filter_type', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => null,
        'unique' => false,
        'comment' => 'filter attribute'

    ));

$installer->endSetup();