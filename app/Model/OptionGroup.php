<?php
App::uses ('AppModel', 'Model');
/**
 * OptionGroup Model
 *
 * @property Option $Option
 */
class OptionGroup extends AppModel {

	public $title_for_layout = 'Nhóm thuộc tính';
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array (
		'name' => array (
			'notEmpty' => array (
				'rule' => array ('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array (
		'Option' => array (
			'className' => 'Option',
			'foreignKey' => 'option_group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	public function getOptions () {
		$result = $this->find('all');
		return $result;
	}
}
