<?php
App::uses('AppController', 'Controller');
/**
 * Promotes Controller
 *
 * @property Promote $Promote
 * @property PaginatorComponent $Paginator
 */
class PromotesController extends AppController {

	public $title_for_layout = 'Khuyến mãi';

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
		$types = array(
			0 => 'VNĐ',
			1 => '%',
		);
		$this->set(compact('types'));
		parent::beforeFilter();
	}
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Promote->recursive = 0;
		$this->set('promotes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Promote->exists($id)) {
			throw new NotFoundException(__('Invalid promote'));
		}
		$options = array('conditions' => array('Promote.' . $this->Promote->primaryKey => $id));
		$this->set('promote', $this->Promote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Promote->create();
			if ($this->Promote->save($this->request->data)) {
				$this->Session->setFlash(__('The promote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The promote could not be saved. Please, try again.'));
			}
		}
		$stores = $this->Promote->Store->find('list');
		$this->set(compact('stores'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Promote->exists($id)) {
			throw new NotFoundException(__('Invalid promote'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Promote->save($this->request->data)) {
				$this->Session->setFlash(__('The promote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The promote could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Promote.' . $this->Promote->primaryKey => $id));
			$this->request->data = $this->Promote->find('first', $options);
		}
		$stores = $this->Promote->Store->find('list');
		$this->set(compact('stores'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Promote->id = $id;
		if (!$this->Promote->exists()) {
			throw new NotFoundException(__('Invalid promote'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Promote->delete()) {
			$this->Session->setFlash(__('The promote has been deleted.'));
		} else {
			$this->Session->setFlash(__('The promote could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
