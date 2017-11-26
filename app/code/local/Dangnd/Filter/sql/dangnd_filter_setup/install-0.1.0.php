<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 25-10-2017
 * Time: 02:19 CH
 */ 
/* @var $this Mage_Eav_Model_Entity_Setup*/

$this->getConnection()->addColumn(
    $this->getTable('catalog/eav_attribute'), 'filter_type', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable'  => true,
        'comment'   => 'Filter Type'
    )
);