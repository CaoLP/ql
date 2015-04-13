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
        $this->StaffAttendance->recursive = -1;
        $users = $this->StaffAttendance->User->find('list');
        $this->loadModel('WorkSession');
        $worksessions = $this->WorkSession->find('all');
        $res = array();
        $date = date('Y-m-01');
        $end = date('Y-m-t');
        while (strtotime($date) <= strtotime($end)) {
            $staff_attendances = $this->StaffAttendance->find('all',array(
                'conditions' => array('StaffAttendance.time like' => $date .'%'),
            ));
            foreach($staff_attendances as $s){
                array_push($res,$s);
            }
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
        $res = Set::combine($res,'{n}.StaffAttendance.id','{n}','{n}.StaffAttendance.staff_work_session_id');

//        foreach($staff_attendances as $ws){
//            foreach($ws as $staff_at){
//                debug($staff_at['StaffAttendance']['time']);
//            }
//        }
        debug($res);die;

        $this->set(compact('staff_attendances','users','worksessions'));

        if(isset($this->request->query['sample'])){
            $listAt = $this->StaffAttendance->StaffWorkSession->find('all',array('recursive'=>-1));
            foreach($listAt as $at){
                if($at['StaffWorkSession']['work_session_id'] == 1){
                    $date = new DateTime('2015-03-20 07:00:00');
                }
                if($at['StaffWorkSession']['work_session_id'] == 2){
                    $date = new DateTime('2015-03-20 12:00:00');
                }
                if($at['StaffWorkSession']['work_session_id'] == 3){
                    $date = new DateTime('2015-03-20 17:00:00');
                }
                $staff_id = $at['StaffWorkSession']['staff_id'];
                $saveData=array();
                for($i=0;$i<60;$i++){
                    $date->modify( '+1 day' );
                    $saveData[] = array(
                        'staff_id' => $staff_id,
                        'staff_work_session_id' => $at['StaffWorkSession']['work_session_id'],
                        'time' => $date->format('Y-m-d H:i:s'),
                        'type' => '1',
                        'delay_time' => '0',
                        'note' => '',
                    );

                    $clone = clone $date;
                    $clone->modify( '+5 hours' );
                    $saveData[] = array(
                        'staff_id' => $staff_id,
                        'staff_work_session_id' => $at['StaffWorkSession']['work_session_id'],
                        'time' => $clone->format('Y-m-d H:i:s'),
                        'type' => '2',
                        'delay_time' => '0',
                        'note' => '',
                    );
                }
                $this->StaffAttendance->saveMany($saveData);
            }
            die;
        }
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
            $now =  new DateTime();
            $begin =  new DateTime($this->request->data['begin']);
            $end =  new DateTime($this->request->data['end']);
            $late_early = false;



            $saveData = array('StaffAttendance'=>array(
                'staff_id' => $this->request->data['staff_id'],
                'staff_work_session_id' => $this->request->data['staff_work_session_id'],
                'note' => $this->request->data['note'],
            ));



            if($this->request->data['type'] == 1){
                if($now > $begin){
                    $late_early = true;
                }
                $since_start = $now->diff($begin);
            }
            else{
                if($now < $end){
                    $late_early = true;
                }
                $since_start = $now->diff($end);
            }
            $minutes = $since_start->days * 24 * 60;
            $minutes += $since_start->h * 60;
            $minutes += $since_start->i;
            $delay = $this->request->data['delay'];
            $allow = $minutes - $delay;

            $available = $this->StaffAttendance->find('list', array(
                'conditions'=>array(
                    'staff_id' => $this->request->data['staff_id'],
                    'staff_work_session_id' => $this->request->data['staff_work_session_id'],
                    'StaffAttendance.time like' => $now->format('Y-m-d') .'%'
                )
            ));
            if(count($available) > 0){
                $saveData['StaffAttendance']['id'] = array_keys($available)[0];
            }
            if($this->request->data['type'] == 1){
                $saveData['StaffAttendance']['begin_time'] = date('c');
                $saveData['StaffAttendance']['delay_time_begin'] =$allow;
            }else{
                $saveData['StaffAttendance']['end_time'] = date('c');
                $saveData['StaffAttendance']['delay_time_end'] = $allow;
            }

//            debug($this->request->data);die;
            $this->StaffAttendance->create();
            if ($this->StaffAttendance->save($saveData)) {
                $this->view = 'success';
                if($this->request->data['type'] == 1 && $late_early){
                    $msg = 'Bạn đã trể hơn ' . $allow . ' phút ('.$minutes.' phút/'.$delay.' phút)<br> Cảm ơn đã điểm danh !';
                }else if ($this->request->data['type'] == 2 && $late_early){
                    $msg = 'Bạn về sớm hơn ' . $allow . ' phút ('.$minutes.' phút/'.$delay.' phút)<br> Cảm ơn đã điểm danh !';
                }else{
                    if($this->request->data['type'] == 1){
                        $msg = 'Bạn đi làm đúng giờ <br> Cảm ơn đã điểm danh !';
                    }else{
                        $msg = 'Bạn về đúng giờ <br> Cảm ơn đã điểm danh !';
                    }
                }
                $this->set(compact('msg'));
            } else {

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
            $full_data = $this->StaffAttendance->getWorkingTimebyCode($code);
            if(count($full_data) > 0){
                $data = $full_data['work_session'];
                $attended = $full_data['today_attendance'];
                $attended = Set::combine($attended,'{n}.StaffAttendance.type','{n}.StaffAttendance.type','{n}.StaffAttendance.staff_work_session_id');
                $result = array();
                $result[0]['id'] = $data[0]['User']['id'];
                $result[0]['label'] = $data[0]['User']['name'];
                $result[0]['value'] = $data[0]['User']['name'];
                $result[0]['work_session'] = array();
                foreach($data as $d){
                    $temp = $d['WorkSession'];
                    $temp['attended'] = array();
                    if(isset($attended[$temp['id']])){
                        $temp['attended'] = $attended[$temp['id']];
                    }
                    array_push($result[0]['work_session'],$temp);
                }
                echo json_encode($result);
            }
//        }
        die;
    }
}
