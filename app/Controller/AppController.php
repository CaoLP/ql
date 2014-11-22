<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
            'Session',
            'Auth' => array(
								'loginRedirect' => array('admin'=>true,'controller' => 'dashboard', 'action' => 'index'),
								'logoutRedirect' => array('admin'=>true,'controller' => 'users', 'action' => 'login'),
								'authError' => 'You must be logged in to view this page.',
								'loginError' => 'Invalid Username or Password entered, please try again.',
								'Form' => array(
									'scope'  => array('User.status' => 1)
								),
								'authorize' => array(
									'Actions' => array('actionPath' => 'controllers')
								)
    						),
			'Menu'
	);
	public $uses = array('Setting');
    // only allow the login controllers only
    public function beforeFilter() {
        $this->Auth->allow('login');
		if(isset($this->title_for_layout)){$this->set('title_for_layout',$this->title_for_layout);}
		$statuses = array(
			0 => 'Chưa kích hoạt',
			1 => 'Kích hoạt',
		);
		$this->set(compact('statuses'));
        if($this->Session->read('Auth.User.group_id') == 1){
            $this->Toolbar = $this->Components->load('DebugKit.Toolbar');
        }
        parent::beforeFilter();
    }

    public function isAuthorized($user) {
        // Here is where we should verify the role and give access based on role
//        return true;
    }
	public function render($view = null, $layout = null) {
        if(!$this->request->isAjax()){
            list($plugin, ) = pluginSplit(App::location(get_parent_class($this)));
            if ($plugin) {
                App::build(array(
                    'View' => array(
                        CakePlugin::path($plugin) . 'View' . DS,
                    ),
                ), App::APPEND);
            }

            if (strpos($view, '/') !== false || $this instanceof CakeErrorController) {
                return parent::render($view, $layout);
            }
            $viewPaths = App::path('View', $this->plugin);
            $rootPath = $viewPaths[0] . $this->viewPath . DS;
            $requested = $rootPath . $view . '.ctp';
            if (in_array($this->request->action, array('admin_edit', 'admin_add', 'edit', 'add'))) {
                $viewPath = $rootPath . $this->request->action . '.ctp';
                if (!file_exists($requested) && !file_exists($viewPath)) {
                    if (strpos($this->request->action, 'admin_') === false) {
                        $view = 'form';
                    } else {
                        $view = 'admin_form';
                    }
                }
            }
            return parent::render($view, $layout);
        }else{
            return parent::render($view, $layout);
        }
	}
}
