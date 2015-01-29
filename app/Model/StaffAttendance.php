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
}
