<?php

App::uses('AppController', 'Controller');

/**
 * StaffTimesheets Controller
 *
 * @property StaffTimesheet $StaffTimesheet
 */
class StaffTimesheetController extends AppController {

	public $title_for_layout = 'Điểm danh & chấm công';
	
    function beforeFilter() {
        parent::beforeFilter();
        
        //$this->layout = "twitter_full";
    }    
    /**
     * index method
     *
     * @return void
     */
    public function admin_index() {
        $this->set('title', __('StaffTimesheets'));
        $this->set('description', __('Manage StaffTimesheets'));
        $this->StaffTimesheet->recursive = 0;
        if(isset($this->request->data['user_id']) && $this->request->data['user_id']!=''){
            $timesheets = $this->StaffTimesheet->find('all',array(
                    'conditions' => array(
                        'StaffTimesheet.user_id'=>$this->request->data['user_id']
                    )
            ));
        }else{
            $timesheets = array();
        }
        $this->set(compact('timesheets'));
        $this->loadModel('User');
        $users = $this->User->find('list',array('conditions'=>array('User.group_id <>'=>1,'User.status'=>1)));
        $this->set(compact('users'));
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        $this->StaffTimesheet->id = $id;
        if (!$this->StaffTimesheet->exists()) {
            throw new NotFoundException(__('Invalid timesheet'));
        }
        $this->set('timesheet', $this->StaffTimesheet->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add() {
        if($this->request->isAjax()){
            if ($this->request->is('post')) {
                $this->loadModel('User');
                $data = $this->User->find('first',array(
                    'conditions' => array(
                        'User.id'=>$this->request->data['Code']['id'],
                        'User.code'=>$this->request->data['Code']['code']
                    )
                ));
                if(count($data)){
                    $this->StaffTimesheet->save(array('StaffTimesheet'=>array(
                        'user_id' => $this->request->data['Code']['id'],
                        'type' => $this->request->data['Code']['type'],
                        'note' => $this->request->data['Code']['note'],
                    )));
                    echo json_encode(array('code'=>1,'msg'=>'Chào mừng ["'.$data['User']['name'].'"] vào phiên làm việc'));
                }else{
                    echo json_encode(array('code'=>0,'msg'=>'Mã nhân viên không đúng'));
                }
//                $this->StaffTimesheet->create();
//                if ($this->StaffTimesheet->save($this->request->data)) {
//                    $this->Session->setFlash(__('The timesheet has been saved'), 'success');
//                    $this->redirect(array('action' => 'index'));
//                } else {
//                    $this->Session->setFlash(__('The timesheet could not be saved. Please, try again.'), 'error');
//                }
            }else{
                echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập vào tác vụ này'));
            }
        }
        die;
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->StaffTimesheet->id = $id;
        if (!$this->StaffTimesheet->exists()) {
            throw new NotFoundException(__('Invalid timesheet'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->StaffTimesheet->save($this->request->data)) {
                $this->Session->setFlash(__('The timesheet has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The timesheet could not be saved. Please, try again.'), 'error');
            }
        } else {
            $this->request->data = $this->StaffTimesheet->read(null, $id);
        }
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->StaffTimesheet->id = $id;
        if (!$this->StaffTimesheet->exists()) {
            throw new NotFoundException(__('Invalid timesheet'), 'error');
        }
        if ($this->StaffTimesheet->delete()) {
            $this->Session->setFlash(__('StaffTimesheet deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('StaffTimesheet was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }

}
?>