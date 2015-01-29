<?php
App::uses('AppController', 'Controller');
/**
 * StaffAttendances Controller
 *
 * @property StaffAttendance $StaffAttendance
 * @property PaginatorComponent $Paginator
 */
class StaffAttendancesController extends AppController {

    public $title_for_layout = 'Điểm danh nhân viên';
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('admin_add');
    }
    /**
     * index method
     *
     * @return void
     */
    public function admin_index() {
        $this->StaffAttendance->recursive = 0;
        $this->set('staff_attendances', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->StaffAttendance->exists($id)) {
            throw new NotFoundException(__('Invalid staff_attendance'));
        }
        $options = array('conditions' => array('StaffAttendance.' . $this->StaffAttendance->primaryKey => $id));
        $this->set('staff_attendance', $this->StaffAttendance->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->StaffAttendance->create();
            if ($this->StaffAttendance->save($this->request->data)) {
                $this->Session->setFlash(__('The staff_attendance has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The staff_attendance could not be saved. Please, try again.'));
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
        if (!$this->StaffAttendance->exists($id)) {
            throw new NotFoundException(__('Invalid staff_attendance'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->StaffAttendance->save($this->request->data)) {
                $this->Session->setFlash(__('The staff_attendance has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The staff_attendance could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('StaffAttendance.' . $this->StaffAttendance->primaryKey => $id));
            $this->request->data = $this->StaffAttendance->find('first', $options);
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
        $this->StaffAttendance->id = $id;
        if (!$this->StaffAttendance->exists()) {
            throw new NotFoundException(__('Invalid staff_attendance'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->StaffAttendance->delete()) {
            $this->Session->setFlash(__('The staff_attendance has been deleted.'));
        } else {
            $this->Session->setFlash(__('The staff_attendance could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
