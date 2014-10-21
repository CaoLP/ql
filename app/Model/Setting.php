<?php
App::uses('AppModel', 'Model');
/**
 * Setting Model
 *
 * @property  $
 */
class Setting extends AppModel {

	/**
	 * Validation
	 *
	 * @var array
	 * @access public
	 */
	public $validate = array(
		'type' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Creater' => array(
			'className' => 'User',
			'foreignKey' => 'created_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Updater' => array(
			'className' => 'User',
			'foreignKey' => 'updated_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public function getType(){
		$result =  $this->find('all',array('fields'=>'DISTINCT type'));
		$result = Set::classicExtract($result,'{n}.Setting.type');
		return $result;
	}
}
