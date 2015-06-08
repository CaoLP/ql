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
        $salaries = $this->StaffAttendance->StaffWorkSession->find('list',array(
            'fields' =>'temp_id, basic_salary'
        ));
        $this->loadModel('WorkSession');
        $worksessions_d = $this->WorkSession->find('all', array('recursive'=>-1));
        $res = array();
        if(!empty($this->request->data['month']) && !empty($this->request->data['year'])){
            $time = strtotime($this->request->data['year'].'-'.$this->request->data['month'].'-01');
            $date = date('Y-m-01',$time);
            $end = date('Y-m-t',$time);
        }else{
            $this->request->data['year'] = date('Y');
            $this->request->data['month'] = date('m');
            $date = date('Y-m-01');
            $end = date('Y-m-t');
        }
        while (strtotime($date) <= strtotime($end)) {
            $staff_attendances = $this->StaffAttendance->find('all',array(
                'conditions' => array(
                    'OR' => array(
                        'StaffAttendance.begin_time like' => $date .'%',
                        'StaffAttendance.end_time like' => $date .'%',
                    )
                ),
            ));
            foreach($staff_attendances as $s){
                $date2 =  new DateTime($s['StaffAttendance']['end_time']);
                $date1 =  new DateTime($s['StaffAttendance']['begin_time']);
                $temp = $s;
                $total = 0;
                if($s['StaffAttendance']['end_time'] == '0000-00-00 00:00:00'){
                    $temp['StaffAttendance']['date'] = strtotime($date1->format('Y-m-d'));
                    $temp['StaffAttendance']['type'] = 2;
                }else if($s['StaffAttendance']['begin_time'] == '0000-00-00 00:00:00'){
                    $temp['StaffAttendance']['date'] = strtotime($date2->format('Y-m-d'));
                    $temp['StaffAttendance']['type'] = 1;
                }else{
                    $temp['StaffAttendance']['type'] = 0;
                    if($date1 < $date2){
                        $dateDiff = $date2->diff($date1);
                        $total = $dateDiff->h * 60 + $dateDiff->i;
                        $temp['StaffAttendance']['date'] = strtotime($date2->format('Y-m-d'));
                    }else{
                        $temp['StaffAttendance']['date'] = strtotime($date1->format('Y-m-d'));
                    }
                }
                $temp['StaffAttendance']['total'] = $total;
                $res[$temp['StaffAttendance']['staff_id']][$temp['StaffAttendance']['staff_work_session_id']][] = $temp;
//                array_push($res,$temp);
            }
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
//        $res = Set::combine($res,'{n}.StaffAttendance.id','{n}','{n}.StaffAttendance.staff_work_session_id');
//        debug($res);

//        die;

//        foreach($staff_attendances as $ws){
//            foreach($ws as $staff_at){
//                debug($staff_at['StaffAttendance']['time']);
//            }
//        }
        $staff_attendances = $res;
        $years = array();
        $months = array();
        for($i = 1; $i <= 12; $i++){
            $months[$i] = $i;
            $years[(date('Y') - 4)+$i] = (date('Y') - 4)+$i;
        }
        $this->set(compact('staff_attendances','users','worksessions_d','salaries','years','months','end'));
        /*
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
                            $clone = clone $date;
                            $clone->modify( '+5 hours' );
                            $saveData[] = array(
                                'staff_id' => $staff_id,
                                'staff_work_session_id' => $at['StaffWorkSession']['work_session_id'],
                                'begin_time' => $date->format('Y-m-d H:i:s'),
                                'end_time' => $clone->format('Y-m-d H:i:s'),
                                'delay_time_begin' => '0',
                                'delay_time_end' => '0',
                                'note_begin' => '0',
                                'note_end' => '0',
                            );
                        }
                        $this->StaffAttendance->saveMany($saveData);
                    }
                    die;
                }
                */
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return voidaaaaaa
     */
    public function admin_view($id = null)
    {
        $years = array();
        $months = array();
        for($i = 1; $i <= 12; $i++){
            $months[$i] = $i;
            $years[(date('Y') - 4)+$i] = (date('Y') - 4)+$i;
        }
        $conditions = array(
            array(
                'StaffAttendance.staff_id' => $id
            )
        );
        if(isset($this->request->data['year']) && isset($this->request->data['month'])){
            $d = date('Y-m', strtotime($this->request->data['year'].'-'.$this->request->data['month'].'-'. 1));
            $conditions['StaffAttendance.begin_time like'] = '%'.$d.'%';
        }else{
            $this->request->data['year'] = date('Y');
            $this->request->data['month'] = date('m');
            $conditions['StaffAttendance.begin_time like'] = '%'.date('Y-m').'%';
        }
        $result = $this->StaffAttendance->find('all',array(
               'conditions'=> $conditions
        ));
        $this->loadModel('User');
       $user = $this->User->find('first',array(
           'conditions' => array(
               'User.id' => $id
           )
       ));
        $salary = $this->StaffAttendance->StaffWorkSession->find('all');
        $salary = Set::combine($salary,'{n}.StaffWorkSession.group_id','{n}.StaffWorkSession.basic_salary');
        $this->set('attendances', $result);
        $this->set(compact('years','months','user','salary'));
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
            if(!$late_early){
               $allow = 0;
            }

            $available = $this->StaffAttendance->find('list', array(
                'conditions'=>array(
                    'staff_id' => $this->request->data['staff_id'],
                    'staff_work_session_id' => $this->request->data['staff_work_session_id'],
                    'OR' =>array(
                        'StaffAttendance.begin_time like' => $now->format('Y-m-d') .'%',
                        'StaffAttendance.end_time like' => $now->format('Y-m-d') .'%'
                    )
                )
            ));

            if(count($available) > 0){
                $saveData['StaffAttendance']['id'] = array_keys($available)[0];
            }
            if($this->request->data['type'] == 1){
                $saveData['StaffAttendance']['begin_time'] = date('c');
                $saveData['StaffAttendance']['delay_time_begin'] =$allow;
                $saveData['StaffAttendance']['note_begin'] =$this->request->data['note'];
            }else{
                $saveData['StaffAttendance']['end_time'] = date('c');
                $saveData['StaffAttendance']['delay_time_end'] = $allow;
                $saveData['StaffAttendance']['note_end'] =$this->request->data['note'];
            }
//            debug($this->request->data);die;
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
        $this->StaffAttendance->belongsTo['Staff'] = array(
                                                                    'className' => 'User',
                                                                    'foreignKey' => 'staff_id',
                                                                    'conditions' => '',
                                                                    'fields' => '',
                                                                    'order' => ''
                                                                );
        if (!$this->StaffAttendance->exists($id)) {
            throw new NotFoundException(__('Invalid staff_attendance'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->StaffAttendance->save($this->request->data)) {
                $this->Session->setFlash(__('The staff_attendance has been saved.'));
                return $this->redirect(array('action' => 'view',$this->request->data['StaffAttendance']['staff_id']));
            } else {
                $this->Session->setFlash(__('The staff_attendance could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('StaffAttendance.' . $this->StaffAttendance->primaryKey => $id));
            $this->request->data = $this->StaffAttendance->find('first', $options);
        }
        $staffs = $this->StaffAttendance->Staff->find('list');
        $this->set(compact('staffs'));
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
                $attended = Set::combine($attended,'{n}.StaffAttendance.id','{n}.StaffAttendance','{n}.StaffAttendance.staff_work_session_id');
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
