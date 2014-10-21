<?php
App::uses('Warehouse', 'Model');

/**
 * Warehouse Test Case
 *
 */
class WarehouseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.warehouse',
		'app.store',
		'app.user',
		'app.order',
		'app.customer',
		'app.promote',
		'app.order_detail',
		'app.product',
		'app.product_category',
		'app.category',
		'app.product_option',
		'app.option',
		'app.option_group',
		'app.product_promote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Warehouse = ClassRegistry::init('Warehouse');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Warehouse);

		parent::tearDown();
	}

}
