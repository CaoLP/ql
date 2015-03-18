<?php
App::uses('AppController', 'Controller');
/**
 * StaffAttendances Controller
 *
 * @property StaffAttendance $StaffAttendance
 * @property PaginatorComponent $Paginator
 */
class StaffAttendancesController extends AppController
{

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
        $this->Auth->allow('admin_add', 'admin_user_list');
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_index()
    {
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
    public function admin_view($id = null)
    {
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
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->StaffAttendance->create();
            if ($this->StaffAttendance->save($this->request->data)) {
                $this->Session->setFlash(__('The staff_attendance has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The staff_attendance could not be saved. Please, try again.'));
            }
        }
        if ($this->request->isAjax()) {
            $user_id = $this->request->data('id');
            $data = $this->StaffAttendance->StaffWorkSession->find('all', array(
                'conditions' => array(
                    'User.id' => $user_id
                )
            ));
            $this->set(compact('data'));
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
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
    public function admin_delete($id = null)
    {
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

    public function admin_user_list(){
//        if($this->request->isAjax()){
            $code = $this->request->query('term');
            $data = $this->StaffAttendance->getWorkingTimebyCode($code);
            if(count($data) > 0){
                $result = array();
                $result[0]['id'] = $data[0]['User']['id'];
                $result[0]['label'] = $data[0]['User']['name'];
                $result[0]['value'] = $data[0]['User']['name'];
                $result[0]['work_session'] = array();
                foreach($data as $d){
                    array_push($result[0]['work_session'],$d['WorkSession']);
                }
                echo json_encode($result);
            }
//        }
        die;
    }
}
