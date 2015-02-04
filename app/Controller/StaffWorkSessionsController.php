<?php
App::uses('AppController', 'Controller');
/**
 * StaffWorkSessions Controller
 *
 * @property StaffWorkSession $StaffWorkSession
 * @property PaginatorComponent $Paginator
 */
class StaffWorkSessionsController extends AppController {

    public $title_for_layout = 'Hệ thống cửa hàng';
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
        $this->StaffWorkSession->recursive = 0;
        $this->set('staff_work_sessions', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->StaffWorkSession->exists($id)) {
            throw new NotFoundException(__('Invalid staff_work_session'));
        }
        $options = array('conditions' => array('StaffWorkSession.' . $this->StaffWorkSession->primaryKey => $id));
        $this->set('staff_work_session', $this->StaffWorkSession->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->StaffWorkSession->create();
            if ($this->StaffWorkSession->save($this->request->data)) {
                $this->Session->setFlash(__('The staff_work_session has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The staff_work_session could not be saved. Please, try again.'));
            }
        }else{
            $staffs = $this->StaffWorkSession->User->find('list');
            $workSessions = $this->StaffWorkSession->WorkSession->find('list');
            $this->set(compact('staffs','workSessions'));
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
        if (!$this->StaffWorkSession->exists($id)) {
            throw new NotFoundException(__('Invalid staff_work_session'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->StaffWorkSession->save($this->request->data)) {
                $this->Session->setFlash(__('The staff_work_session has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The staff_work_session could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('StaffWorkSession.' . $this->StaffWorkSession->primaryKey => $id));
            $this->request->data = $this->StaffWorkSession->find('first', $options);
            $staffs = $this->StaffWorkSession->User->find('list');
            $workSessions = $this->StaffWorkSession->WorkSession->find('list');
            $this->set(compact('staffs','workSessions'));
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
        $this->StaffWorkSession->id = $id;
        if (!$this->StaffWorkSession->exists()) {
            throw new NotFoundException(__('Invalid staff_work_session'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->StaffWorkSessionn->delete()) {
            $this->Session->setFlash(__('The staff_work_session has been deleted.'));
        } else {
            $this->Session->setFlash(__('The staff_work_session could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
