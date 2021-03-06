<?php
App::uses('AppModel', 'Model');
/**
 * Order Model
 *
 * @property Customer $Customer
 * @property User $User
 * @property Promote $Promote
 * @property OrderDetail $OrderDetail
 */
class Order extends AppModel
{

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'customer_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'amount' => array(
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
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id',
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
        ),
        'Store' => array(
            'className' => 'Store',
            'foreignKey' => 'store_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Promote' => array(
            'className' => 'Promote',
            'foreignKey' => 'promote_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'OrderDetail' => array(
            'className' => 'OrderDetail',
            'foreignKey' => 'order_id',
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

    public function getReportOrderDetails($option)
    {
        $this->belongsTo = array();
        $option['conditions']['Order.status'] = 1;
        return $this->find('all', $option);
    }

    public function getReportOrder($option)
    {
        $this->belongsTo = array();
        $this->recursive = -1;
        $option['conditions']['Order.status'] = 1;
        return $this->find('all', $option);
    }

    public function getOrderList($option)
    {
        $this->belongsTo = array();
        $option['conditions']['Order.status'] = 1;
        return $this->find('all', $option);
    }

    public function doFilter($inputs)
    {
        $this->belongsTo = array(
            'Customer' => array(
                'className' => 'Customer',
                'foreignKey' => 'customer_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
            )
        );

        $conditions = array(
            'Order.status' => 1
        );
        if(isset($inputs['term'])){
            $conditions['Order.code like'] = '%'.$inputs['term'].'%';
        }
        if(isset($inputs['customer_id'])){
            $conditions['Order.customer_id'] = $inputs['customer_id'];
        }
        return $this->find('all',array(
           'conditions' => $conditions,
            'limit'=>10
        ));
    }
}
