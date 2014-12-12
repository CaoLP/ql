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
        $settings = array();
        $this->Warehouse->recursive = 0;
//        $store_id = $this->Session->read('Auth.User.store_id');
        if($this->request->is('post')){
            if(isset($this->request->data['q'])){
                $input =$this->request->data['q'];
                $settings['conditions']['OR'] =  array(
                    'Product.name like' => '%' . $input . '%',
                    'Warehouse.code like' => '%' . $input . '%'
                );
            }
            if(isset($this->request->data['category_id']) && !empty($this->request->data['category_id'])){
                $settings['conditions']['Product.category_id'] = $this->request->data['category_id'];
            }
            if(isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])){
                $settings['conditions']['Warehouse.store_id'] = $this->request->data['store_id'];
            }

            if(isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])){
                $settings['conditions']['Warehouse.store_id'] = $this->request->data['store_id'];
            }
            if(isset($this->request->data['option_id']) && count($this->request->data['option_id'])>0){
                foreach($this->request->data['option_id'] as $option){
                    $settings['conditions']['AND'][] = 'FIND_IN_SET(\''. $option .'\',Warehouse.options)';
                }
            }
            $this->Session->write('Warehouse.paginate',$settings);
            $this->Session->write('Warehouse.request.data',$this->request->data);
            return $this->redirect(array('action'=>'index'));
        }
        if($this->Session->check('Warehouse.paginate')){
            $this->paginate = $this->Session->read('Warehouse.paginate');
        }
        if($this->Session->check('Warehouse.request.data')){
            $this->request->data = $this->Session->read('Warehouse.request.data');
        }
//        $this->Paginator->settings = $settings;
        $this->loadModel('Option');
        $options = $this->Option->find('all');
        $stores = $this->Warehouse->Store->find('list');
        $this->loadModel('Category');
        $categories = $this->Category->find('list');
        $optionsData = Set::combine($options,'{n}.Option.id','{n}.Option.name');
        $options = Set::combine($options,'{n}.Option.id',array('{0} ({1})','{n}.Option.name','{n}.Option.code'),'{n}.OptionGroup.name');

        $this->set(compact('options','optionsData','stores','categories'));
        $this->set('warehouses', $this->Paginator->paginate('Warehouse'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_ajax_product($store_id = '')
    {
        $this->layout = 'ajax';
        $settings = array('limit'=>8);
        $this->loadModel('Option');
        $options = $this->Option->find('list');
        if($this->request->is('post')){
            $settings['conditions']['Warehouse.store_id'] = $store_id;
            if(isset($this->request->data['q'])){
                $input =$this->request->data['q'];
                $settings['conditions']['OR'] =  array(
                    'Product.name like' => '%' . $input . '%',
                    'Warehouse.code like' => '%' . $input . '%'
                );
            }
            if(isset($this->request->data['category_id']) && !empty($this->request->data['category_id'])){
                $settings['conditions']['Product.category_id'] = $this->request->data['category_id'];
            }
            $this->Session->write('Warehouse.ajax_paginate',$settings);
        }
        if($this->Session->check('Warehouse.paginate')){
            $settings = $this->Session->read('Warehouse.ajax_paginate');
        }
        $this->paginate =  $settings;
        $warehouses = $this->Paginator->paginate('Warehouse');
        $temp = array();
        foreach ($warehouses as $item) {
            $sub = array();
            $sub['sku'] = $item['Product']['sku'];
            $sub['name'] = $item['Product']['name'];
            $sub['id'] = $item['Product']['id'];
            $sub['price'] = $item['Warehouse']['price'];
            $sub['retail_price'] = $item['Warehouse']['retail_price'];
            $sub['options'] = $item['Warehouse']['options'];
            $sub['qty'] = $item['Warehouse']['qty'];
            $sub['warehouse'] = $item['Warehouse']['id'];
            $sub['code'] = $item['Warehouse']['code'];
            $opts = explode(',',$item['Warehouse']['options']);
            $optsName = array();
            foreach($opts as $op){
                if(isset($options[$op]))
                $optsName[] = $options[$op];
            }
            $sub['optionsName'] = implode(',',$optsName);
            $sub['data'] = json_encode($sub);
            $sub['thumbnail'] = $item['Product']['thumbnail'];
            $temp[] = $sub;
        }
        $warehouses = $temp;
        $this->set(compact('warehouses'));
    }
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
            $sub['retail_price'] = $item['Warehouse']['retail_price'];
            $sub['options'] = $item['Warehouse']['options'];
            $sub['qty'] = $item['Warehouse']['qty'];
            $sub['warehouse'] = $item['Warehouse']['id'];
            $sub['code'] = $item['Warehouse']['code'];
            $opts = explode(',',$item['Warehouse']['options']);
            $optsName = array();
            foreach($opts as $op){
                if(isset($options[$op]))
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
                $name =  $this->request->data['P']['name'];
                $sku =  $this->request->data['P']['sku'];
                $oldPrice =  $this->request->data['P']['price'];
                $oldRetailPrice =  $this->request->data['P']['retail_price'];
                $oldQty =  $this->request->data['P']['qty'];

                $store =  $this->request->data['P']['store'];

                $newQty =  $this->request->data['Warehouse']['qty'];
                $newPrice =  $this->request->data['Warehouse']['price'];
                $newRetailPrice =  $this->request->data['Warehouse']['retail_price'];

                $saveLog = true;

                $message = '[<strong>Kho hàng</strong>]['.$store.'] <strong>'.$this->Session->read('Auth.User.name') . '</strong> đã thay đổi ';
                if($oldPrice != $newPrice && $newQty != $oldQty && $oldRetailPrice != $newRetailPrice){
                    $message .= 'giá và số lượng của sản phẩm ' . $name . '( '.$sku.' ) '.
                        '(Giá lẻ ['.number_format($oldPrice, 0, '.', ',').']->['.number_format($newPrice, 0, '.', ',').']; '.
                        'Giá sỉ ['.number_format($oldRetailPrice, 0, '.', ',').']->['.number_format($newRetailPrice, 0, '.', ',').']; '.
                        'Số lượng  ['.$oldQty.']->['.$newQty.'])';
                }else if( $oldPrice != $newPrice){
                    $message .= 'giá bán lẻ của sản phẩm ' . $name . '( '.$sku.' ) (Giá lẻ ['.number_format($oldPrice, 0, '.', ',').']->['.number_format($newPrice, 0, '.', ',').'])';
                }else if( $oldRetailPrice != $newRetailPrice){
                    $message .= 'giá bán sỉ của sản phẩm ' . $name . '( '.$sku.' ) (Giá sỉ ['.number_format($oldRetailPrice, 0, '.', ',').']->['.number_format($newRetailPrice, 0, '.', ',').'])';
                }else if($oldQty != $newQty){
                    $message .= 'số lượng của sản phẩm ' . $name . '( '.$sku.' ) (Số lượng  ['.$oldQty.']->['.$newQty.'])';
                }else{
                    $saveLog = false;
                }

               if($saveLog){
                   $this->loadModel('ActionLog');
                   $this->ActionLog->save(array(
                       'ActionLog'=>array(
                           'message' => $message
                       )
                   ));
               }
                if($this->request->isAjax()){
                    die;
                }
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
