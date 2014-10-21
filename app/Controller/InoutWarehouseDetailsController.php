<?php
App::uses('AppController', 'Controller');
/**
 * InoutWarehouseDetails Controller
 *
 * @property InoutWarehouseDetail $InoutWarehouseDetail
 * @property PaginatorComponent $Paginator
 */
class InoutWarehouseDetailsController extends AppController {

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
		$this->InoutWarehouseDetail->recursive = 0;
		$this->set('inoutWarehouseDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->InoutWarehouseDetail->exists($id)) {
			throw new NotFoundException(__('Invalid inout warehouse detail'));
		}
		$options = array('conditions' => array('InoutWarehouseDetail.' . $this->InoutWarehouseDetail->primaryKey => $id));
		$this->set('inoutWarehouseDetail', $this->InoutWarehouseDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->InoutWarehouseDetail->create();
			if ($this->InoutWarehouseDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The inout warehouse detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inout warehouse detail could not be saved. Please, try again.'));
			}
		}
		$inoutWarehouses = $this->InoutWarehouseDetail->InoutWarehouse->find('list');
		$products = $this->InoutWarehouseDetail->Product->find('list');
		$this->set(compact('inoutWarehouses', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->InoutWarehouseDetail->exists($id)) {
			throw new NotFoundException(__('Invalid inout warehouse detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InoutWarehouseDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The inout warehouse detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inout warehouse detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('InoutWarehouseDetail.' . $this->InoutWarehouseDetail->primaryKey => $id));
			$this->request->data = $this->InoutWarehouseDetail->find('first', $options);
		}
		$inoutWarehouses = $this->InoutWarehouseDetail->InoutWarehouse->find('list');
		$products = $this->InoutWarehouseDetail->Product->find('list');
		$this->set(compact('inoutWarehouses', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->InoutWarehouseDetail->id = $id;
		if (!$this->InoutWarehouseDetail->exists()) {
			throw new NotFoundException(__('Invalid inout warehouse detail'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->InoutWarehouseDetail->delete()) {
			$this->Session->setFlash(__('The inout warehouse detail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The inout warehouse detail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
