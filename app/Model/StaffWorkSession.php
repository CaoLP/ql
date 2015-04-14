<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/28/14
 * Time: 2:42 PM
 */
App::uses('AppModel', 'Model');

class StaffWorkSession extends AppModel
{
    public $useTable = 'staff_work_sessions';
    public $virtualFields = array(
        'temp_id' => 'CONCAT(StaffWorkSession.staff_id, "-", StaffWorkSession.work_session_id)'
    );
    public $belongsTo = array(
        'WorkSession' => array(
            'className' => 'WorkSession',
            'foreignKey' => 'work_session_id',
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
