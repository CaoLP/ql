<?php
App::uses('AppController', 'Controller');
/**
 * ActionLogs Controller
 *
 * @property ActionLog $ActionLog
 * @property PaginatorComponent $Paginator
 */
class ActionLogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $title_for_layout = 'Quản lý logs';
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
        if($this->request->isAjax()){
            $this->layout = 'ajax';
            $this->view = 'admin_index_ajax';
        }
		$this->ActionLog->recursive = 0;
        $conds = array();
        $conds['order'] = 'ActionLog.created DESC';
        $this->Paginator->settings = $conds;
		$this->set('action_logs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ActionLog->exists($id)) {
			throw new NotFoundException(__('Invalid action_log'));
		}
		$options = array('conditions' => array('ActionLog.' . $this->ActionLog->primaryKey => $id));
		$this->set('action_log', $this->ActionLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ActionLog->create();
			if ($this->ActionLog->save($this->request->data)) {
				$this->Session->setFlash(__('The action_log has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The action_log could not be saved. Please, try again.'));
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
		if (!$this->ActionLog->exists($id)) {
			throw new NotFoundException(__('Invalid action_log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ActionLog->save($this->request->data)) {
				$this->Session->setFlash(__('The action_log has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The action_log could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ActionLog.' . $this->ActionLog->primaryKey => $id));
			$this->request->data = $this->ActionLog->find('first', $options);
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
		$this->ActionLog->id = $id;
		if (!$this->ActionLog->exists()) {
			throw new NotFoundException(__('Invalid action_log'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ActionLog->delete()) {
			$this->Session->setFlash(__('The action_log has been deleted.'));
		} else {
			$this->Session->setFlash(__('The action_log could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
