<?php
App::uses('AppController', 'Controller');
/**
 * Reexes Controller
 *
 * @property Reex $Reex
 * @property PaginatorComponent $Paginator
 */
class ReexesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

    public $title_for_layout = 'Quản lý Thu - Chi';


    public function beforeFilter(){

        $this->set('types',array(
            'Phiếu Thu',
            'Phiếu Chi'
        ));

        parent::beforeFilter();
    }
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Reex->recursive = 0;
		$this->set('reexes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Reex->exists($id)) {
			throw new NotFoundException(__('Invalid reex'));
		}
		$options = array('conditions' => array('Reex.' . $this->Reex->primaryKey => $id));
		$this->set('reex', $this->Reex->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Reex->create();
			if ($this->Reex->save($this->request->data)) {
				$this->Session->setFlash(__('The reex has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reex could not be saved. Please, try again.'));
			}
		}
		$stores = $this->Reex->Store->find('list');
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
		if (!$this->Reex->exists($id)) {
			throw new NotFoundException(__('Invalid reex'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reex->save($this->request->data)) {
				$this->Session->setFlash(__('The reex has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reex could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reex.' . $this->Reex->primaryKey => $id));
			$this->request->data = $this->Reex->find('first', $options);
		}
		$stores = $this->Reex->Store->find('list');
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
		$this->Reex->id = $id;
		if (!$this->Reex->exists()) {
			throw new NotFoundException(__('Invalid reex'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Reex->delete()) {
			$this->Session->setFlash(__('The reex has been deleted.'));
		} else {
			$this->Session->setFlash(__('The reex could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
