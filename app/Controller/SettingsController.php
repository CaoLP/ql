<?php
App::uses('AppController', 'Controller');

/**
 * Settings Controller
 *
 * @property Setting $Setting
 * @property PaginatorComponent $Paginator
 */
class SettingsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    public $title_for_layout = 'Tuỳ chỉnh';

    /**
     * index method
     * @param string $key
     * @return void
     */
    public function admin_index($key = null)
    {
        $this->Setting->recursive = 0;
        $this->Paginator->settings = array(
            'contain' => array('Thumb'),
            'conditions' => array(
                'Setting.name <>' => 'temp'
            )
        );
        if (!empty($key)) {
            $this->Paginator->settings['conditions']['ParentSetting.key'] = $key;
            $parent = $this->Setting->find('first', array('conditions' => array('Setting.key' => $key)));
            if (count($parent) > 0) {
                $this->setTitle($parent['Setting']['name']);
            }
            $this->view = 'admin_sub_index';
            $this->set('key', $key);
        }
        $settings = $this->Paginator->paginate();
        $this->set(compact('settings'));
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
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid setting'));
        }
        $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
        $this->set('setting', $this->Setting->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add()
    {
        $temp = array(
            'Setting' => array(
                'name' => 'temp',
                'key' => 'temp',
            )
        );
        $data = $this->Setting->find('first', array('conditions' => array('Setting.name' => 'temp')));
        if ($data) {
            $id = $data['Setting']['id'];
        } else {
            $this->Setting->save($temp);
            $id = $this->Setting->id;
        }

        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid setting'));
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('The setting has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The setting could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
            $this->request->data = $this->Setting->find('first', $options);
        }
        $parents = $this->Setting->ParentSetting->find('list', array('conditions' => array('ParentSetting.key <>' => 'temp')));
        $this->set(compact('parents'));
        $this->view = 'admin_edit';
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add_sub($key, $edit = null, $parent_key = null)
    {
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('The setting has been saved.'), 'default', array('class' => 'alert alert-success'));
                if ($parent_key == null)
                    return $this->redirect(array('action' => 'index', $key));
                else
                    return $this->redirect(array('action' => 'index', $parent_key));
            } else {
                $this->Session->setFlash(__('The setting could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            if ($parent_key != null) {
                $parent = $this->Setting->find('first', array('conditions' => array('Setting.key' => $parent_key)));
            } else {
                $parent = $this->Setting->find('first', array('conditions' => array('Setting.key' => $key)));
            }

            if (count($parent) > 0) {
                $this->setTitle($parent['Setting']['name']);
                $temp = array(
                    'Setting' => array(
                        'name' => 'temp',
                        'key' => 'temp',
                    )
                );
                if ($edit == 'edit') {
                    $data = $this->Setting->find('first', array('conditions' => array('Setting.key' => $key)));
                    $temp = $data;
                } else {
                    $data = $this->Setting->find('first', array('conditions' => array('Setting.name' => 'temp')));
                    if ($data) {
                        $temp = $data;
                        $temp['Setting']['parent_id'] = $parent['Setting']['id'];
                        $temp['Setting']['name'] = '';
                        $temp['Setting']['key'] = '';
                    } else {
                        $this->Setting->save($temp);
                        $temp['Setting']['id'] = $this->Setting->id;
                        $temp['Setting']['parent_id'] = $parent['Setting']['id'];
                        $temp['Setting']['name'] = '';
                        $temp['Setting']['key'] = '';
                    }
                }
                $parents = $this->Setting->ParentSetting->find('list', array('conditions' => array('ParentSetting.key <>' => 'temp')));
                $this->set(compact('parents', 'key', 'parent'));
                if ($parent['ParentSetting']['key'] == 'slide' && !empty($parent['Setting']['parent_id'])) {
                    $this->view = 'admin_add_slide';
                    $temp['Setting']['name'] = $parent['Setting']['key'] . '_' . $temp['Setting']['id'];
                    $temp['Setting']['key'] = $parent['Setting']['key'] . '_' . $temp['Setting']['id'];
                }
                $this->request->data = $temp;
            } else {
                return $this->redirect(array('action' => 'index'));
            }
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
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid setting'));
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('The setting has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The setting could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
            $this->request->data = $this->Setting->find('first', $options);
        }
        $parents = $this->Setting->ParentSetting->find('list', array('conditions' => array('ParentSetting.key <>' => 'temp')));
        $this->set(compact('parents'));
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
        $this->Setting->id = $id;
        if (!$this->Setting->exists()) {
            throw new NotFoundException(__('Invalid setting'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Setting->delete()) {
            $this->Session->setFlash(__('The setting has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The setting could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
