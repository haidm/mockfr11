<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 25-10-2017
 * Time: 02:19 CH
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('dangnd_slider/slide'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'identity' => true,
        'unsigned' => true,
        'primary' => true
    ), 'ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false
    ), 'Name');
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('dangnd_slider/images'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'identity' => true,
        'unsigned' => true,
        'primary' => true
    ), 'ID')
    ->addColumn('slideId', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false
    ), 'Slide Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false
    ), 'Name')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false
    ), 'Content')
    ->addForeignKey($installer->getFkName('dangnd_slider/images', 'slideId',
        'dangnd_slider/slide', 'id'), 'slideId',
        $installer->getTable('dangnd_slider/slide'), 'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE);
$installer->getConnection()->createTable($table);

$installer->endSetup();