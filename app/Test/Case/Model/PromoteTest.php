<?php
App::uses('Promote', 'Model');

/**
 * Promote Test Case
 *
 */
class PromoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.promote',
		'app.order_detail',
		'app.order',
		'app.customer',
		'app.user',
		'app.store',
		'app.warehouse',
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
		$this->Promote = ClassRegistry::init('Promote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Promote);

		parent::tearDown();
	}

}
