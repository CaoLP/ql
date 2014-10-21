<?php
App::uses('AppController', 'Controller');
/**
 * Options Controller
 *
 * @property Option $Option
 * @property PaginatorComponent $Paginator
 */
class OptionsController extends AppController {

	public $title_for_layout = 'Thuộc tính';

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
		$this->Option->recursive = 0;
		$this->set('options', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Option->exists($id)) {
			throw new NotFoundException(__('Invalid option'));
		}
		$options = array('conditions' => array('Option.' . $this->Option->primaryKey => $id));
		$this->set('option', $this->Option->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Option->create();
			if ($this->Option->save($this->request->data)) {
				$this->Session->setFlash(__('The option has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.'));
			}
		}
		$optionGroups = $this->Option->OptionGroup->find('list');
		$this->set(compact('optionGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Option->exists($id)) {
			throw new NotFoundException(__('Invalid option'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Option->save($this->request->data)) {
				$this->Session->setFlash(__('The option has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Option.' . $this->Option->primaryKey => $id));
			$this->request->data = $this->Option->find('first', $options);
		}
		$optionGroups = $this->Option->OptionGroup->find('list');
		$this->set(compact('optionGroups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Option->id = $id;
		if (!$this->Option->exists()) {
			throw new NotFoundException(__('Invalid option'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Option->delete()) {
			$this->Session->setFlash(__('The option has been deleted.'));
		} else {
			$this->Session->setFlash(__('The option could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
