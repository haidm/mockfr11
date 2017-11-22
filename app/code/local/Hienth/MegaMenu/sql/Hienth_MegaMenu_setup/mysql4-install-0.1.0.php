<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 10/29/2017
 * Time: 9:20 PM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
//table Menu
$table = $installer->getConnection()
    ->newTable($installer->getTable('menu'))
    ->addColumn('id',Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
    ), 'Name')
    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
    ), 'Type')
    ->addColumn('link', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    'nullable'  => false,
    ), 'Link')
    ->addColumn('level', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
    'unsigned'  => true,
    'nullable'  => false,
    ), 'Level')
    ->addColumn('parent_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
    'unsigned'  => true,
    'nullable'  => false,
    ), 'Parent ID');
$installer->getConnection()->createTable($table);


$installer->endSetup();