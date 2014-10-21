<?php
App::uses('ProductPromote', 'Model');

/**
 * ProductPromote Test Case
 *
 */
class ProductPromoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_promote',
		'app.product',
		'app.order_detail',
		'app.order',
		'app.customer',
		'app.user',
		'app.store',
		'app.warehouse',
		'app.promote',
		'app.product_category',
		'app.category',
		'app.product_option',
		'app.option',
		'app.option_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductPromote = ClassRegistry::init('ProductPromote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductPromote);

		parent::tearDown();
	}

}
