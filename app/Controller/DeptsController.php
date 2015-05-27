<?php
App::uses('AppController', 'Controller');
/**
 * Depts Controller
 *
 * @property Reex $Reex
 * @property PaginatorComponent $Paginator
 */
class DeptsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

    public $title_for_layout = 'Quản lý Công nợ';


    public function beforeFilter(){
        parent::beforeFilter();
    }
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Dept->recursive = 0;
		$this->set('depts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Dept->exists($id)) {
			throw new NotFoundException(__('Invalid dept'));
		}
		$options = array('conditions' => array('Dept.' . $this->Dept->primaryKey => $id));
		$this->set('dept', $this->Dept->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Dept->create();
			if ($this->Dept->save($this->request->data)) {
				$this->Session->setFlash(__('The dept has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dept could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Dept->Customer->find('list');
		$this->set(compact('customers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Dept->exists($id)) {
			throw new NotFoundException(__('Invalid dept'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dept->save($this->request->data)) {
				$this->Session->setFlash(__('The dept has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dept could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dept.' . $this->Dept->primaryKey => $id));
			$this->request->data = $this->Dept->find('first', $options);
		}
        $customers = $this->Dept->Customer->find('list');
        $this->set(compact('customers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Dept->id = $id;
		if (!$this->Dept->exists()) {
			throw new NotFoundException(__('Invalid dept'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Dept->delete()) {
			$this->Session->setFlash(__('The dept has been deleted.'));
		} else {
			$this->Session->setFlash(__('The dept could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
