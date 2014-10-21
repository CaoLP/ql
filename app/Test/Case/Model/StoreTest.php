<?php
App::uses('Store', 'Model');

/**
 * Store Test Case
 *
 */
class StoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.product_promote',
		'app.warehouse'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Store = ClassRegistry::init('Store');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Store);

		parent::tearDown();
	}

}
