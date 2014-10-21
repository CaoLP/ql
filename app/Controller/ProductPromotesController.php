<?php
App::uses('AppController', 'Controller');
/**
 * ProductPromotes Controller
 *
 * @property ProductPromote $ProductPromote
 * @property PaginatorComponent $Paginator
 */
class ProductPromotesController extends AppController {

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
		$this->ProductPromote->recursive = 0;
		$this->set('productPromotes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductPromote->exists($id)) {
			throw new NotFoundException(__('Invalid product promote'));
		}
		$options = array('conditions' => array('ProductPromote.' . $this->ProductPromote->primaryKey => $id));
		$this->set('productPromote', $this->ProductPromote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductPromote->create();
			if ($this->ProductPromote->save($this->request->data)) {
				$this->Session->setFlash(__('The product promote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product promote could not be saved. Please, try again.'));
			}
		}
		$products = $this->ProductPromote->Product->find('list');
		$promotes = $this->ProductPromote->Promote->find('list');
		$this->set(compact('products', 'promotes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductPromote->exists($id)) {
			throw new NotFoundException(__('Invalid product promote'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductPromote->save($this->request->data)) {
				$this->Session->setFlash(__('The product promote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product promote could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductPromote.' . $this->ProductPromote->primaryKey => $id));
			$this->request->data = $this->ProductPromote->find('first', $options);
		}
		$products = $this->ProductPromote->Product->find('list');
		$promotes = $this->ProductPromote->Promote->find('list');
		$this->set(compact('products', 'promotes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductPromote->id = $id;
		if (!$this->ProductPromote->exists()) {
			throw new NotFoundException(__('Invalid product promote'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProductPromote->delete()) {
			$this->Session->setFlash(__('The product promote has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product promote could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
