<?php
App::uses('AppController', 'Controller');
/**
 * OrderDetails Controller
 *
 * @property OrderDetail $OrderDetail
 * @property PaginatorComponent $Paginator
 */
class OrderDetailsController extends AppController {

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
		$this->OrderDetail->recursive = 0;
		$this->set('orderDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->OrderDetail->exists($id)) {
			throw new NotFoundException(__('Invalid order detail'));
		}
		$options = array('conditions' => array('OrderDetail.' . $this->OrderDetail->primaryKey => $id));
		$this->set('orderDetail', $this->OrderDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->OrderDetail->create();
			if ($this->OrderDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The order detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order detail could not be saved. Please, try again.'));
			}
		}
		$orders = $this->OrderDetail->Order->find('list');
		$products = $this->OrderDetail->Product->find('list');
		$stores = $this->OrderDetail->Store->find('list');
		$promotes = $this->OrderDetail->Promote->find('list');
		$this->set(compact('orders', 'products', 'stores', 'promotes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->OrderDetail->exists($id)) {
			throw new NotFoundException(__('Invalid order detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OrderDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The order detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OrderDetail.' . $this->OrderDetail->primaryKey => $id));
			$this->request->data = $this->OrderDetail->find('first', $options);
		}
		$orders = $this->OrderDetail->Order->find('list');
		$products = $this->OrderDetail->Product->find('list');
		$stores = $this->OrderDetail->Store->find('list');
		$promotes = $this->OrderDetail->Promote->find('list');
		$this->set(compact('orders', 'products', 'stores', 'promotes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->OrderDetail->id = $id;
		if (!$this->OrderDetail->exists()) {
			throw new NotFoundException(__('Invalid order detail'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->OrderDetail->delete()) {
			$this->Session->setFlash(__('The order detail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The order detail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
