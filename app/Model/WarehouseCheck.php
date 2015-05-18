<?php
App::uses('AppModel', 'Model');
/**
 * Warehouse Model
 *
 * @property Store $Store
 * @property Product $Product
 */
class WarehouseCheck extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'warehouse_check';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array();

    public $hasMany = array(
        'WarehouseCheckDetail' => array(
            'className' => 'WarehouseCheckDetail',
            'foreignKey' => 'warehouse_check_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
}
