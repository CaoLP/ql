<?php
App::uses('AppModel', 'Model');
/**
 * Warehouse Model
 *
 * @property Store $Store
 * @property Product $Product
 */
class WarehouseCheckDetail extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'warehouse_check_details';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Store' => array(
			'className' => 'Store',
			'foreignKey' => 'store_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'WarehouseCheck' => array(
            'className' => 'WarehouseCheck',
            'foreignKey' => 'warehouse_check_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
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
}
