<?php
App::uses('AppController', 'Controller');
/**
 * AdminMenus Controller
 *
 * @property AdminMenu $AdminMenu
 * @property PaginatorComponent $Paginator
 */
class AdminMenusController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	/**
	 * Components
	 *
	 * @var array
	 */
	public $uses = array('AdminMenu','Group');
	public $title_for_layout = 'Quản lý menu';
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AdminMenu->recursive = 0;
		$this->set('adminMenus', $this->AdminMenu->find('threaded'));
//		$this->set('adminMenus', $this->Paginator->paginate());
		$groups = $this->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AdminMenu->exists($id)) {
			throw new NotFoundException(__('Invalid admin menu'));
		}
		$options = array('conditions' => array('AdminMenu.' . $this->AdminMenu->primaryKey => $id));
		$this->set('adminMenu', $this->AdminMenu->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AdminMenu->create();
			$this->request->data['AdminMenu']['group_ids'] = implode(',',$this->request->data['AdminMenu']['group_ids']);
			if ($this->AdminMenu->save($this->request->data)) {
				$this->Session->setFlash(__('The admin menu has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin menu could not be saved. Please, try again.'));
			}
		}
		$groups = $this->Group->find('list');
		$parents = $this->AdminMenu->ParentAdminMenu->generateTreeList($conditions=null, $keyPath=null, $valuePath=null, $spacer= '╟─', $recursive=null);
		$this->set(compact('groups', 'parents'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->AdminMenu->exists($id)) {
			throw new NotFoundException(__('Invalid admin menu'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['AdminMenu']['group_ids'] = implode(',',$this->request->data['AdminMenu']['group_ids']);
			if ($this->AdminMenu->save($this->request->data)) {
				$this->Session->setFlash(__('The admin menu has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin menu could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AdminMenu.' . $this->AdminMenu->primaryKey => $id));
			$this->request->data = $this->AdminMenu->find('first', $options);
		}
		$groups = $this->Group->find('list');
		$parents = $this->AdminMenu->ParentAdminMenu->find('list');
		$this->set(compact('groups', 'parents'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->AdminMenu->id = $id;
		if (!$this->AdminMenu->exists()) {
			throw new NotFoundException(__('Invalid admin menu'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AdminMenu->delete()) {
			$this->Session->setFlash(__('The admin menu has been deleted.'));
		} else {
			$this->Session->setFlash(__('The admin menu could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
