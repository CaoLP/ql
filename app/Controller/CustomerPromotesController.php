<?php
App::uses('AppController', 'Controller');
/**
 * CustomerPromotes Controller
 *
 * @property CustomerPromote $CustomerPromote
 * @property PaginatorComponent $Paginator
 */
class CustomerPromotesController extends AppController
{

    public $title_for_layout = 'Khuyến mãi cho khách';
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
        $name='';
        $promote_code='';
        $promote_type='';
        $status='';
        if(isset($this->request->query['data']['name'])) $name = $this->request->query['data']['name'];
        if(isset($this->request->query['data']['promote_code'])) $promote_code = $this->request->query['data']['promote_code'];
        if(isset($this->request->query['data']['promote_type'])) $promote_type = $this->request->query['data']['promote_type'];
        if(isset($this->request->query['data']['status'])) $status = $this->request->query['data']['status'];
        $op_promote = array(
            'CustomerPromote' => array(
                'conditions' => array(
                    'Customer.name LIKE'=>'%'.$name.'%',
                    'CustomerPromote.promote_code LIKE'=>'%'.$promote_code.'%'
                )
            ));

        if($promote_type!=0) $op_promote ['CustomerPromote']['conditions']['CustomerPromote.promote_id']=$promote_type;
        if($status!=0) $op_promote ['CustomerPromote']['conditions']['CustomerPromote.used']=$status;

        $this->paginate = $op_promote;

        $this->CustomerPromote->recursive = 0;
        $this->set('customerPromotes', $this->Paginator->paginate());
        $this->set('promotes', $this->CustomerPromote->Promote->find('list'));
        $this->set(compact('promote_code','status','promote_type','name'));
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
        if (!$this->CustomerPromote->exists($id)) {
            throw new NotFoundException(__('Invalid customer promote'));
        }
        $options = array('conditions' => array('CustomerPromote.' . $this->CustomerPromote->primaryKey => $id));
        $this->set('customerPromote', $this->CustomerPromote->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->CustomerPromote->create();
            $promote = $this->CustomerPromote->Promote->find('first', array(
                    'conditions' =>
                        array(
                            'Promote.id' => $this->request->data['CustomerPromote']['promote_id']
                        )
                )
            );
            $promote_code = $promote['Promote']['code'].uniqid();
            $this->request->data['CustomerPromote']['promote_code'] = $promote_code;
            if ($this->CustomerPromote->save($this->request->data)) {
                $this->Session->setFlash(__('The customer promote has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer promote could not be saved. Please, try again.'));
            }
        }
        $customers = $this->CustomerPromote->Customer->find('list');
        $promotes = $this->CustomerPromote->Promote->find('list');
        $this->set(compact('customers', 'promotes'));
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
        if (!$this->CustomerPromote->exists($id)) {
            throw new NotFoundException(__('Invalid customer promote'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->CustomerPromote->save($this->request->data)) {
                $this->Session->setFlash(__('The customer promote has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer promote could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('CustomerPromote.' . $this->CustomerPromote->primaryKey => $id));
            $this->request->data = $this->CustomerPromote->find('first', $options);
        }
        $customers = $this->CustomerPromote->Customer->find('list');
        $promotes = $this->CustomerPromote->Promote->find('list');
        $this->set(compact('customers', 'promotes'));
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
        $this->CustomerPromote->id = $id;
        if (!$this->CustomerPromote->exists()) {
            throw new NotFoundException(__('Invalid customer promote'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->CustomerPromote->delete()) {
            $this->Session->setFlash(__('The customer promote has been deleted.'));
        } else {
            $this->Session->setFlash(__('The customer promote could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    public function admin_toggle($id,$tog) {
        if($this->request->isAjax()){
            $this->CustomerPromote->id = $id;
            $arr = array();
//            if($tog == 0) $tog =1;
//            else $tog =0;
            $tog =1;
            $arr['used'] = $tog;
            $arr['store_id'] = $this->Session->read ('Auth.User.Store.id');
            if(!$this->CustomerPromote->save($arr)){
                if($tog == 0) $tog =1;
                else $tog =0;
            }
            $this->layout = 'ajax';
            $this->set(compact('id','tog'));
        }
    }
}
