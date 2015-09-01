<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 */
class CustomersController extends AppController {

	public $title_for_layout = 'Khách hàng';
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            if(isset($this->request->query['term']) && !isset($this->request->query['use_phone'])){
                $customers = $this->Customer->search($this->request->query['term'], true, false);
                echo json_encode($customers);
				die;
			}else{
				$customers = $this->Customer->search($this->request->query['term'], true, true);
				$this->set(compact('customers'));
				$this->view = 'customer_ajax';
			}
        }else{
			$this->loadModel('Store');
			$stores = $this->Store->find('list');
			if($this->request->is('post')){
				$this->layout = 'excel';
				$conditions = array();
				if($this->request->data('type')!= 'all'){
					$conditions['Customer.gender'] = $this->request->data('type');
				}
				if($this->request->data('store') != 'all'){
					$conditions['Creater.store_id'] = $this->request->data('store');
				}
				if($this->request->data('phone') != 'all'){
					switch($this->request->data('phone')){
						case 1:
							$conditions['OR'] = array(
								array('Customer.phone like' => '097%'),
								array('Customer.phone like' => '098%'),
								array('Customer.phone like' => '0163%'),
								array('Customer.phone like' => '0164%'),
								array('Customer.phone like' => '0165%'),
								array('Customer.phone like' => '0166%'),
								array('Customer.phone like' => '0167%'),
								array('Customer.phone like' => '0168%'),
								array('Customer.phone like' => '0169%'),
							);
							break;
						case 2:
							$conditions['OR'] = array(
								array('Customer.phone like' => '090%'),
								array('Customer.phone like' => '093%'),
								array('Customer.phone like' => '0120%'),
								array('Customer.phone like' => '0121%'),
								array('Customer.phone like' => '0122%'),
								array('Customer.phone like' => '0126%'),
								array('Customer.phone like' => '0128%'),
							);
							break;
						case 3:
							$conditions['OR'] = array(
								array('Customer.phone like' => '091%'),
								array('Customer.phone like' => '094%'),
								array('Customer.phone like' => '0123%'),
								array('Customer.phone like' => '0124%'),
								array('Customer.phone like' => '0125%'),
								array('Customer.phone like' => '0127%'),
								array('Customer.phone like' => '0129%'),
							);
							break;
						case 4:
							$conditions['OR'] = array(
								array('Customer.phone like' => '092%'),
								array('Customer.phone like' => '0188%'),
							);
							break;
						case 5:
							$conditions['OR'] = array(
								array('Customer.phone like' => '0996%'),
								array('Customer.phone like' => '0199%'),
							);
							break;
						case 6:
							$conditions['OR'] = array(
								array('Customer.phone like' => '095%')
							);
							break;
						case 7:
							$conditions[] = array(
								array('Customer.phone not like' => '097%'),
								array('Customer.phone not like' => '098%'),
								array('Customer.phone not like' => '0163%'),
								array('Customer.phone not like' => '0164%'),
								array('Customer.phone not like' => '0165%'),
								array('Customer.phone not like' => '0166%'),
								array('Customer.phone not like' => '0167%'),
								array('Customer.phone not like' => '0168%'),
								array('Customer.phone not like' => '0169%'),
								array('Customer.phone not like' => '090%'),
								array('Customer.phone not like' => '093%'),
								array('Customer.phone not like' => '0120%'),
								array('Customer.phone not like' => '0121%'),
								array('Customer.phone not like' => '0122%'),
								array('Customer.phone not like' => '0126%'),
								array('Customer.phone not like' => '0128%'),
								array('Customer.phone not like' => '091%'),
								array('Customer.phone not like' => '094%'),
								array('Customer.phone not like' => '0123%'),
								array('Customer.phone not like' => '0124%'),
								array('Customer.phone not like' => '0125%'),
								array('Customer.phone not like' => '0127%'),
								array('Customer.phone not like' => '0129%'),
								array('Customer.phone not like' => '092%'),
								array('Customer.phone not like' => '0188%'),
								array('Customer.phone not like' => '0996%'),
								array('Customer.phone not like' => '0199%'),
								array('Customer.phone not like' => '095%'),
							);
							break;
					}
				}
				if($this->request->data('birth') != 0){
					$conditions['Customer.birthday LIKE'] = "%'".date('m-d')."'";
				}
				$total = 0;
				if($this->request->data('total')){
					$total = $this->request->data('total');
				}
				$this->set(compact('total'));

				if($this->request->data('code') != 'all'){
					if($this->request->data('code') == 1){
						$conditions['AND'] = array(
							'OR' => array(
								array('Customer.code <>' => null),
								array('Customer.code <>' => '')
							)
						);
					}else{
						$conditions['AND'] = array(
							'OR' => array(
								array('Customer.code' => null),
								array('Customer.code' => '')
							)
						);
					}
				}
				$data = $this->Customer->find('all', array('conditions'=>$conditions, 'rescursive'=> -1));
				$this->set(compact('data'));
				$this->view = 'export_customer';
			}else{
				$this->Customer->recursive = 0;
				$this->set('customers', $this->Paginator->paginate());
			}
			$this->set(compact('stores'));
        }
	}
    public function admin_search() {
        $name = $this->request->data('name');
        $this->Customer->recursive = 0;
         $this->paginate = array(
            'conditions' => array(
				'OR' => array(
					'Customer.name LIKE'=>'%'.$name.'%',
					'Customer.code'=> $name
				)
            )
        );
        $this->set('customers', $this->Paginator->paginate());
        $this->view = 'admin_index';
    }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
        $promote_code='';
        $promote_type='';
        $status='';
        if(isset($this->request->query['data']['promote_code'])) $promote_code = $this->request->query['data']['promote_code'];
        if(isset($this->request->query['data']['promote_type'])) $promote_type = $this->request->query['data']['promote_type'];
        if(isset($this->request->query['data']['status'])) $status = $this->request->query['data']['status'];
		$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
		$this->set('customer', $this->Customer->find('first', $options));
        $this->loadModel('CustomerPromote');
        $op_promote = array(
            'CustomerPromote' => array(
                'conditions' => array(
                    'CustomerPromote.customer_id'=>$id,
                    'CustomerPromote.promote_code LIKE'=>'%'.$promote_code.'%'
                )
            ));

        if($promote_type!=0) $op_promote ['CustomerPromote']['conditions']['CustomerPromote.promote_id']=$promote_type;
        if($status!=0) $op_promote ['CustomerPromote']['conditions']['CustomerPromote.used']=$status;

        $this->paginate = $op_promote;


		$this->set('customerPromotes', $this->paginate('CustomerPromote'));
		$this->set('promotes', $this->CustomerPromote->Promote->find('list'));
        $this->set(compact('promote_code','status','promote_type'));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
        if($this->request->isAjax()){
            $this->layout = 'ajax';
            $this->Customer->create();
            $this->Customer->save($this->request->data);
            $customers = $this->Customer->find('list');
            $temp = array();
            foreach($customers as $key=>$val){
                $temp[] = array('value'=>$key,'label'=>$val);
            }
            $customers = $temp;
            $this->set(compact('customers'));
            $this->view = 'admin_index_ajax';
        }else{
		if ($this->request->is('post')) {
			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('The customer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
			}
		}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('The customer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
			$this->request->data = $this->Customer->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Customer->delete()) {
			$this->Session->setFlash(__('The customer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The customer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
