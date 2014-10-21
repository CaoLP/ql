<?php
App::uses('Option', 'Model');

/**
 * Option Test Case
 *
 */
class OptionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Option = ClassRegistry::init('Option');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Option);

		parent::tearDown();
	}

}
