<?php
App::uses('Customer', 'Model');

/**
 * Customer Test Case
 *
 */
class CustomerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.customer',
		'app.order',
		'app.user',
		'app.store',
		'app.order_detail',
		'app.product',
		'app.product_category',
		'app.category',
		'app.product_option',
		'app.option',
		'app.option_group',
		'app.product_promote',
		'app.promote',
		'app.warehouse'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Customer = ClassRegistry::init('Customer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Customer);

		parent::tearDown();
	}

}
