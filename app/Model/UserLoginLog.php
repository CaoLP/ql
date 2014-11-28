<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/28/14
 * Time: 2:42 PM
 */
App::uses('AppModel', 'Model');

class UserLoginLog extends AppModel {
    public $useTable = 'user_login_logs';

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
