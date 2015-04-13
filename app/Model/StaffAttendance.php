<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/28/14
 * Time: 2:42 PM
 */
App::uses('AppModel', 'Model');

class StaffAttendance extends AppModel
{
    public $useTable = 'staff_attendances';

    public $belongsTo = array(
        'StaffWorkSession' => array(
            'className' => 'StaffWorkSession',
            'foreignKey' => 'staff_work_session_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'staff_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


    public function getWorkingTimebyCode($code){
        $result = array();

        $result['work_session'] = $this->StaffWorkSession->find('all',array(
            'conditions' => array(
                'User.code' => $code
            )
        ));

        if(isset($result['work_session'][0]))
        $result['today_attendance'] = $this->find('all',array(
            'fields' => 'staff_work_session_id,type',
            'conditions' => array(
                'StaffAttendance.staff_id' => $result['work_session'][0]['StaffWorkSession']['staff_id'],
                'StaffAttendance.time like' => date('Y-m-d') . '%'
            ),
            'recursive' => -1
        ));
        return $result;
    }
}
