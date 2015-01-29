<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/28/14
 * Time: 2:42 PM
 */
App::uses('AppModel', 'Model');

class WorkSession extends AppModel {
    public $useTable = 'work_sessions';

    public $belongsTo = array();
}
