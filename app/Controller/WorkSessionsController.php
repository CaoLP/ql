<?php
App::uses('AppController', 'Controller');
/**
 * WorkSessions Controller
 *
 * @property WorkSession $WorkSession
 * @property PaginatorComponent $Paginator
 */
class WorkSessionsController extends AppController {

    public $title_for_layout = 'Quản lý ca làm';
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
        $this->WorkSession->recursive = 0;
        $this->set('work_sessions', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->WorkSession->exists($id)) {
            throw new NotFoundException(__('Invalid work_session'));
        }
        $options = array('conditions' => array('WorkSession.' . $this->WorkSession->primaryKey => $id));
        $this->set('work_session', $this->WorkSession->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->WorkSession->create();
            if ($this->WorkSession->save($this->request->data)) {
                $this->Session->setFlash(__('The work_session has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The work_session could not be saved. Please, try again.'));
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
        if (!$this->WorkSession->exists($id)) {
            throw new NotFoundException(__('Invalid work_session'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->WorkSession->save($this->request->data)) {
                $this->Session->setFlash(__('The work_session has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The work_session could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('WorkSession.' . $this->WorkSession->primaryKey => $id));
            $this->request->data = $this->WorkSession->find('first', $options);
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
        $this->WorkSession->id = $id;
        if (!$this->WorkSession->exists()) {
            throw new NotFoundException(__('Invalid work_session'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->WorkSession->delete()) {
            $this->Session->setFlash(__('The work_session has been deleted.'));
        } else {
            $this->Session->setFlash(__('The work_session could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
