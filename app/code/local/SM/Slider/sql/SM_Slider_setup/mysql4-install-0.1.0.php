<?php

$installer = $this;

$installer->startSetup();
$sliderTable = $installer->getConnection()
    ->newTable($installer->getTable('sm_slider'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,));
$installer->getConnection()->createTable($sliderTable);

$imageTable = $installer->getConnection()
    ->newTable($installer->getTable('sm_image'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn('link', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ),'Link')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ),'Name')
    ->addColumn('text', Varien_Db_Ddl_Table::TYPE_TEXT, array(
        'nullable' => true,
    ),'text');
$installer->getConnection()->createTable($imageTable);

$listImage = $installer->getConnection()
    ->newTable($installer->getTable('sm_listimage'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn('slider_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'nullable' => false,
        'unsigned' => true,
    ))
    ->addColumn('image_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'nullable' => false,
        'unsigned' => true,
    ))->addForeignKey(
        $installer->getFkName('sm_listimage', 'slider_id', 'sm_slider','id'),
        'slider_id',
        $installer->getTable('sm_slider'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )->addForeignKey(
        $installer->getFkName('sm_listimage', 'image_id', 'sm_image','id'),
        'image_id',
        $installer->getTable('sm_image'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );
$installer->getConnection()->createTable($listImage);


$installer->endSetup();