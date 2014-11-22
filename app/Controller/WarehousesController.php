<?php
App::uses('AppController', 'Controller');
/**
 * Warehouses Controller
 *
 * @property Warehouse $Warehouse
 * @property PaginatorComponent $Paginator
 */
class WarehousesController extends AppController
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
        $this->set('title_for_layout', 'Nhà kho');
        $this->Warehouse->recursive = 0;
//        $store_id = $this->Session->read('Auth.User.store_id');
//        $this->Paginator->settings = array(
//            'conditions'=>array(
//                'Warehouse.store_id'=> $store_id
//            ),
//        );
        $this->loadModel('Option');
        $options = $this->Option->find('list');
        $this->set(compact('options'));
        $this->set('warehouses', $this->Paginator->paginate());
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_product_ajax($store_id = '')
    {
        //if($this->request->isAjax()){
        $input='';
        if(isset($this->request->query['term'])) $input = $this->request->query['term'];
        $result = $this->Warehouse->filterData($input,$store_id);
        $this->loadModel('Option');
        $options = $this->Option->find('list');
        $temp = array();
        foreach ($result as $item) {
            $sub = array();
            $sub['sku'] = $item['Product']['sku'];
            $sub['name'] = $item['Product']['name'];
            $sub['id'] = $item['Product']['id'];
            $sub['price'] = $item['Warehouse']['price'];
            $sub['options'] = $item['Warehouse']['options'];
            $sub['qty'] = $item['Warehouse']['qty'];
            $sub['warehouse'] = $item['Warehouse']['id'];
            $sub['code'] = $item['Warehouse']['code'];
            $opts = explode(',',$item['Warehouse']['options']);
            $optsName = array();
            foreach($opts as $op){
                $optsName[] = $options[$op];
            }
            $sub['optionsName'] = implode(',',$optsName);
            $temp[]['Product'] = $sub;
        }
        $result = json_encode($temp);
        echo $result;
        // }
        die;
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
        if (!$this->Warehouse->exists($id)) {
            throw new NotFoundException(__('Invalid warehouse'));
        }
        $options = array('conditions' => array('Warehouse.' . $this->Warehouse->primaryKey => $id));
        $this->set('warehouse', $this->Warehouse->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Warehouse->create();
            if ($this->Warehouse->save($this->request->data)) {
                $this->Session->setFlash(__('The warehouse has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The warehouse could not be saved. Please, try again.'));
            }
        }
        $stores = $this->Warehouse->Store->find('list');
        $products = $this->Warehouse->Product->find('list');
        $this->set(compact('stores', 'products'));
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
        if (!$this->Warehouse->exists($id)) {
            throw new NotFoundException(__('Invalid warehouse'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Warehouse->save($this->request->data)) {
                $this->Session->setFlash(__('The warehouse has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The warehouse could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Warehouse.' . $this->Warehouse->primaryKey => $id));
            $this->request->data = $this->Warehouse->find('first', $options);
        }
        $stores = $this->Warehouse->Store->find('list');
        $products = $this->Warehouse->Product->find('list');
        $this->set(compact('stores', 'products'));
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
        $this->Warehouse->id = $id;
        if (!$this->Warehouse->exists()) {
            throw new NotFoundException(__('Invalid warehouse'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Warehouse->delete()) {
            $this->Session->setFlash(__('The warehouse has been deleted.'));
        } else {
            $this->Session->setFlash(__('The warehouse could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
