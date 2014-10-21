<?php
App::uses('ProductOption', 'Model');

/**
 * ProductOption Test Case
 *
 */
class ProductOptionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_option',
		'app.option',
		'app.option_group',
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
		'app.product_promote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductOption = ClassRegistry::init('ProductOption');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductOption);

		parent::tearDown();
	}

}
