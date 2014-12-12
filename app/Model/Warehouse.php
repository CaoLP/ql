<?php
App::uses('AppModel', 'Model');
/**
 * Warehouse Model
 *
 * @property Store $Store
 * @property Product $Product
 */
class Warehouse extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'warehouse';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'store_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
    public function filterData($input,$store_id)
    {
        $this->belongsTo = array(
            'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ));
        $result = $this->find('all', array(
            'fields'=>'Product.sku,Product.name,Product.thumbnail,Warehouse.retail_price,Product.id,Warehouse.price,Warehouse.options,Warehouse.qty,Warehouse.code,Warehouse.id',
            'conditions' => array(
                'Warehouse.qty > '=>'0',
                'Warehouse.store_id'=> $store_id,
                'OR' => array(
//                    'Product.name like' => '%' . $input . '%',
//                    'Product.sku like' => '%' . $input . '%'
                    'Warehouse.code' => $input
                ),
            )
        ));
        return $result;
    }
    public function filterWarehouseData($store_id)
    {
        $this->belongsTo = array(
            'Product' => array(
                'className' => 'Product',
                'foreignKey' => 'product_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
            ));
        $result = $this->find('all', array(
            'fields'=>'Product.sku,Product.name,Product.thumbnail,Warehouse.retail_price,Product.id,Warehouse.price,Warehouse.options,Warehouse.qty,Warehouse.code,Warehouse.id',
            'conditions' => array(
                'Warehouse.qty > '=>'0',
                'Warehouse.store_id'=> $store_id
            )
        ));
        return $result;
    }
}
