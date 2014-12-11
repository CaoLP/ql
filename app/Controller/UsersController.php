<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController
{
    public $scaffold = 'admin';

    /**
     * Components
     *
     * @var array
     */
    public $title_for_layout = 'Nhân viên';
    public $components = array('Paginator');

    public function beforeFilter()
    {

        parent::beforeFilter();
        $this->Auth->allow('admin_login', 'admin_register');

//		$this->User->bindModel(array('belongsTo'=>array(
//			'Group' => array(
//				'className' => 'Group',
//				'foreignKey' => 'group_id',
//				'dependent'=>true
//			)
//		)), false);

    }

    public function admin_login()
    {
        $this->layout = 'login';
        //if already logged-in, redirect
        if ($this->Session->check('Auth.User')) {
            $this->redirect(array('admin' => true, 'controller' => 'dashboard', 'action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->loadModel('UserLoginLog');
                $this->UserLoginLog->save(array('UserLoginLog' => array('user_id' => $this->Auth->user('id'), 'type' => 0)));
                $this->Session->setFlash(__('Welcome, ' . $this->Auth->user('username')), 'message', array('class' => 'alert-success'));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid username or password'), 'message', array('class' => 'alert-danger'));
            }
        }
    }

    public function admin_logout()
    {
        $this->loadModel('UserLoginLog');
        $this->UserLoginLog->save(array('UserLoginLog' => array('user_id' => $this->Auth->user('id'), 'type' => 1)));
        $this->Session->setFlash('Good-Bye', 'message', array('class' => 'alert-success'));
        $this->redirect($this->Auth->logout());
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', 'Quản lý nhân viên');
        $this->User->recursive = 0;
        $this->paginate = array(
            'conditions'=> array(
                'User.status' => 1
            )
        );
        $this->set('users', $this->Paginator->paginate());
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            if (empty($this->request->data['User']['code'])) {
                $random = substr(number_format(time() * mt_rand(), 0, '', ''), 0, 10);
                $this->request->data['User']['code'] = $random;
            }
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'message', array('class' => 'alert-success'));
                die;
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
            }
        }
        $stores = $this->User->Store->find('list');
        $this->set(compact('stores'));
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * register method
     *
     * @return void
     */
    public function admin_register()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['group_id'] = 5;
            $random = substr(number_format(time() * mt_rand(), 0, '', ''), 0, 10);
            $this->request->data['User']['code'] = $random;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'message', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
            }
        }
        $stores = $this->User->Store->find('list');
        $this->set(compact('stores'));
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (empty($this->request->data['User']['code'])) {
                $random = substr(number_format(time() * mt_rand(), 0, '', ''), 0, 10);
                $this->request->data['User']['code'] = $random;
            }
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'message', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $stores = $this->User->Store->find('list');
        $this->set(compact('stores'));
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_change()
    {
        $id = $this->Session->read('Auth.User.id');
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (empty($this->request->data['User']['code'])) {
                $random = substr(number_format(time() * mt_rand(), 0, '', ''), 0, 10);
                $this->request->data['User']['code'] = $random;
            }
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'message', array('class' => 'alert-success'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
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
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
//		$this->request->allowMethod('post', 'delete');
        $data = array(
            'User' => array(
                'id' => $id,
                'status' => '2'
            )
        );
        if ($this->User->save($data)) {
            $this->Session->setFlash(__('The user has been deleted.'), 'message', array('class' => 'alert-success'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'), 'message', array('class' => 'alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
