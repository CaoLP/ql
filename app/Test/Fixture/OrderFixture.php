<?php
/**
 * OrderFixture
 *
 */
class OrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'amount' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'ship' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'ship_increment_price' => array('type' => 'float', 'null' => true, 'default' => '0', 'unsigned' => false),
		'ship_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ship_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ship_address_alt' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ship_district' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ship_city' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ship_phone' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 20, 'unsigned' => false),
		'status' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'promote_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'promote_value' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'promote_type' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'customer_id' => 1,
			'user_id' => 1,
			'amount' => 1,
			'ship' => 1,
			'ship_increment_price' => 1,
			'ship_name' => 'Lorem ipsum dolor sit amet',
			'ship_address' => 'Lorem ipsum dolor sit amet',
			'ship_address_alt' => 'Lorem ipsum dolor sit amet',
			'ship_district' => 'Lorem ipsum dolor ',
			'ship_city' => 'Lorem ipsum dolor ',
			'ship_phone' => 1,
			'status' => 1,
			'created' => '2014-08-04 10:17:19',
			'created_by' => 1,
			'updated' => '2014-08-04 10:17:19',
			'updated_by' => 1,
			'promote_id' => 1,
			'promote_value' => 1,
			'promote_type' => 1
		),
	);

}
