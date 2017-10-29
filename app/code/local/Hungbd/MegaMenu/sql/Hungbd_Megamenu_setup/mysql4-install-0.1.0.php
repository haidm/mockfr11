<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 14:53
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$table = $installer->getConnection()
    ->newTable($installer->getTable('menuitem'))
    ->addColumn('id',Varien_Db_Ddl_Table::TYPE_INTEGER,11,array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ),'Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
    ),'Name menuitem')
    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
    ),'Type of menuitem')
    ->addColumn('link', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
    ),'link')
    ->addColumn('level', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'nullable'  => false,
    ),'level')
    ->addColumn('parent_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'nullable'  => true,
    ),'parent id');

$installer->getConnection()->createTable($table);
$installer->endSetup();