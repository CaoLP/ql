<?php
App::uses('AppController', 'Controller');
/**
 * Warehouses Controller
 *
 * @property Warehouse $Warehouse
 * @property PaginatorComponent $Paginator
 */
class WarehousesController extends AppController {

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
		$this->Warehouse->recursive = 0;
		$this->set('warehouses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Warehouse->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse'));
		}
		$options = array('conditions' => array('Warehouse.' . $this->Warehouse->primaryKey => $id));
		$this->set('warehouse', $this->Warehouse->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Warehouse->create();
			if ($this->Warehouse->save($this->request->data)) {
				$this->Session->setFlash(__('The warehouse has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The warehouse could not be saved. Please, try again.'));
			}
		}
		$stores = $this->Warehouse->Store->find('list');
		$products = $this->Warehouse->Product->find('list');
		$this->set(compact('stores', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Warehouse->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Warehouse->save($this->request->data)) {
				$this->Session->setFlash(__('The warehouse has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The warehouse could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Warehouse.' . $this->Warehouse->primaryKey => $id));
			$this->request->data = $this->Warehouse->find('first', $options);
		}
		$stores = $this->Warehouse->Store->find('list');
		$products = $this->Warehouse->Product->find('list');
		$this->set(compact('stores', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Warehouse->id = $id;
		if (!$this->Warehouse->exists()) {
			throw new NotFoundException(__('Invalid warehouse'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Warehouse->delete()) {
			$this->Session->setFlash(__('The warehouse has been deleted.'));
		} else {
			$this->Session->setFlash(__('The warehouse could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
