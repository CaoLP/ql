<?php
/**
 * WarehouseFixture
 *
 */
class WarehouseFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'warehouse';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'store_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'qty' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'store_id' => 1,
			'product_id' => 1,
			'qty' => 1,
			'created' => '2014-08-04 10:17:20',
			'created_by' => 1,
			'updated' => '2014-08-04 10:17:20',
			'updated_by' => 1
		),
	);

}
