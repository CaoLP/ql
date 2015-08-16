<?php
App::uses('AppController', 'Controller');
/**
 * FrontMenus Controller
 *
 * @property AdminMenu $FrontMenus
 * @property PaginatorComponent $Paginator
 */
class FrontMenusController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function admin_index()
    {
        $frontMenus = $this->FrontMenu->find('all', array('conditions'=>array('FrontMenu.parent_id'=>'')));
        $this->set(compact('frontMenus'));
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
        if (!$this->FrontMenu->exists($id)) {
            throw new NotFoundException(__('Invalid menu'));
        }
        $options = array('conditions' => array('FrontMenu.' . $this->FrontMenu->primaryKey => $id));
        $this->set('frontMenu', $this->FrontMenu->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->FrontMenu->create();
            if ($this->FrontMenu->save($this->request->data)) {
                $this->Session->setFlash(__('The menu has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The menu could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $parentFrontMenus = $this->FrontMenu->ParentFrontMenu->find('list');
        $menuPositions = $this->FrontMenu->MenuPosition->find('list');
        $this->set('parents',$parentFrontMenus);
        $this->set('menuPositions',$menuPositions);
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
        if (!$this->FrontMenu->exists($id)) {
            throw new NotFoundException(__('Invalid menu'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->FrontMenu->save($this->request->data)) {
                $this->Session->setFlash(__('The menu has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The menu could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('FrontMenu.' . $this->FrontMenu->primaryKey => $id));
            $this->request->data = $this->FrontMenu->find('first', $options);
        }
        $parentFrontMenus = $this->FrontMenu->ParentFrontMenu->find('list');
        $menuPositions = $this->FrontMenu->MenuPosition->find('list');
        $this->set('parents',$parentFrontMenus);
        $this->set('menuPositions',$menuPositions);
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
        $this->FrontMenu->id = $id;
        if (!$this->FrontMenu->exists()) {
            throw new NotFoundException(__('Invalid menu'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->FrontMenu->delete()) {
            $this->Session->setFlash(__('The menu has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The menu could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function getPageActionList()
    {
        $controllerClasses = App::objects('controller');
        foreach ($controllerClasses as $controller) {
            if ($controller != 'AppController' && $controller == 'PagesController') {
                // Load the controller
                App::import('Controller', str_replace('Controller', '', $controller));
                // Load its methods / actions
                $actionMethods = get_class_methods($controller);
                foreach ($actionMethods as $key => $method) {

                    if ($method{0} == '_') {
                        unset($actionMethods[$key]);
                    }
                }
                // Load the ApplicationController (if there is one)
                App::import('Controller', 'AppController');
                $parentActions = get_class_methods('AppController');
                $controllers[$controller] = array_diff($actionMethods, $parentActions);
            }
        }
        $temp = array();
        foreach ($controllers as $con => $acts) {
            $con = str_replace('Controller', '', $con);
            $con_name = strtolower(preg_replace('~([a-z])([A-Z])~', '\\1_\\2', $con));
            foreach ($acts as $act) {
                $act_name = strtolower(preg_replace('~([a-z])([A-Z])~', '\\1_\\2', $act));
                $temp[Router::url(array('controller' => $con_name, 'action' => $act_name))] = Router::url(array('controller' => $con_name, 'action' => $act_name));
            }
        }
        return $temp;
    }
}
