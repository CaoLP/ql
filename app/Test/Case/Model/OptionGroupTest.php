<?php
App::uses('OptionGroup', 'Model');

/**
 * OptionGroup Test Case
 *
 */
class OptionGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.option_group',
		'app.option'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OptionGroup = ClassRegistry::init('OptionGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OptionGroup);

		parent::tearDown();
	}

}
