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
            if(isset($this->request->query['term'])){
                $customers = $this->Customer->search($this->request->query['term'], true);
                echo json_encode($customers);
            }
            die;
        }else{
            $this->Customer->recursive = 0;
            $this->set('customers', $this->Paginator->paginate());
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
