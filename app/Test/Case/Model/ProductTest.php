<?php
App::uses('Product', 'Model');

/**
 * Product Test Case
 *
 */
class ProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Product = ClassRegistry::init('Product');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Product);

		parent::tearDown();
	}

}
