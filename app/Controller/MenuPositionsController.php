<?php
App::uses('AppController', 'Controller');
/**
 * MenuPositions Controller
 *
 * @property MenuPosition $MenuPosition
 * @property PaginatorComponent $Paginator
 */
class MenuPositionsController extends AppController {

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
		$this->MenuPosition->recursive = 0;
		$this->set('menuPositions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->MenuPosition->exists($id)) {
			throw new NotFoundException(__('Invalid menu position'));
		}
		$options = array('conditions' => array('MenuPosition.' . $this->MenuPosition->primaryKey => $id));
		$this->set('menuPosition', $this->MenuPosition->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->MenuPosition->create();
			if ($this->MenuPosition->save($this->request->data)) {
				$this->Session->setFlash(__('The menu position has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu position could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->MenuPosition->exists($id)) {
			throw new NotFoundException(__('Invalid menu position'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MenuPosition->save($this->request->data)) {
				$this->Session->setFlash(__('The menu position has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu position could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('MenuPosition.' . $this->MenuPosition->primaryKey => $id));
			$this->request->data = $this->MenuPosition->find('first', $options);
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
		$this->MenuPosition->id = $id;
		if (!$this->MenuPosition->exists()) {
			throw new NotFoundException(__('Invalid menu position'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MenuPosition->delete()) {
			$this->Session->setFlash(__('The menu position has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The menu position could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
