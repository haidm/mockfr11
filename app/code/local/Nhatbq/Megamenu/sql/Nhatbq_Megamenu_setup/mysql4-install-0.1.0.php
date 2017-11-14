<?php 
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
    ),'Menuitem name')
    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
    ),'Menuitem type')
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