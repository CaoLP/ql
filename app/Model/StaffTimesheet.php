<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/28/14
 * Time: 2:42 PM
 */
App::uses('AppModel', 'Model');

class StaffTimesheet extends AppModel {
    public $useTable = 'staff_timesheets';

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
