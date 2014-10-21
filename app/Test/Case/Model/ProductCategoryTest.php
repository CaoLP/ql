<?php
App::uses('ProductCategory', 'Model');

/**
 * ProductCategory Test Case
 *
 */
class ProductCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_category',
		'app.product',
		'app.order_detail',
		'app.order',
		'app.customer',
		'app.user',
		'app.store',
		'app.warehouse',
		'app.promote',
		'app.product_option',
		'app.option',
		'app.option_group',
		'app.product_promote',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductCategory = ClassRegistry::init('ProductCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductCategory);

		parent::tearDown();
	}

}
