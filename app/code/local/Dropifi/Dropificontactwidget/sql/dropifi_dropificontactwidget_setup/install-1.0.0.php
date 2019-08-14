<?php
/*echo 'Running This Upgrade: '.get_class($this)."\n <br /> \n";
die("Exit for now");*/ 
 
$installer = $this;

$table = $installer->getConnection()
    ->newTable($installer->getTable('dropifi_dropificontactwidget/dropificontactwidget'))
    ->addColumn('dropificontactwidget_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'identity' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'Entity id')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => true,
        'default'  => null,
    ), 'Email')
    ->addColumn('password', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => true,
        'default'  => null,
    ), 'Password')
    ->addColumn('dropifi_pkey', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => true,
        'default'  => null,
    ), 'Dropifi Public Key')
    ->addColumn('dropifi_lurl', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => true,
        'default'  => null,
    ), 'Dropifi Login Url')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'Creation Time')
    ->setComment('Accounts Information');

$installer->getConnection()->createTable($table);
?>
