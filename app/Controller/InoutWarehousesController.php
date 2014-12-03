<?php
App::uses('AppController', 'Controller');
/**
 * InoutWarehouses Controller
 *
 * @property InoutWarehouse     $InoutWarehouse
 * @property PaginatorComponent $Paginator
 */
class InoutWarehousesController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public $title_for_layout = 'Quản lý nhập xuất';

    public $status = array();

    public function  beforeRender()
    {
        $wtypes = array(
            'Nhập hàng',
            'Chuyển hàng',
        );
        $this->set(compact('wtypes'));
        if (count($this->status) == 0)
            $this->status = array(
                'Đang chuyển',
                'Đã chuyển',
                'Đã huỷ',
                'Lưu tạm',
            );
        $this->set('status', $this->status);
        parent::beforeRender();
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_index($action = '')
    {
        $this->InoutWarehouse->recursive = 1;
        $conds = array(
            'conditions' => array(
                'InoutWarehouse.type' => '1',
            )
        );
        if(isset($this->request->data['q']) && !empty($this->request->data['q'])){
            $conds['conditions']['InoutWarehouse.code'] = $this->request->data['q'];
        }
        if(isset($this->request->data['from']) && !empty($this->request->data['from'])){
            if(isset($this->request->data['to']) && !empty($this->request->data['to'])){
                $conds['conditions']['InoutWarehouse.created >='] = $this->request->data['from'].' 00:00:00';
                $conds['conditions']['InoutWarehouse.created <='] = $this->request->data['to'].' 23:59:59';
            }
        }
        if ($this->Session->read('Auth.User.group_id') != 1) {
            $conds['conditions']['OR']['InoutWarehouse.store_id'] = $this->Session->read('Auth.User.Store.id');
            $conds['conditions']['OR']['InoutWarehouse.store_receive_id'] = $this->Session->read('Auth.User.Store.id');
        }
        $conds['order'] = 'InoutWarehouse.created DESC';
        $this->Paginator->settings = $conds;

        $this->set('inoutWarehouses', $this->Paginator->paginate());
        $stores = $this->InoutWarehouse->Store->find('list');
        $this->set(compact('stores'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_in()
    {
        $this->title_for_layout = 'Phiếu nhập hàng chờ duyệt';
        $conds = array(
            'conditions' => array(
                'InoutWarehouse.type' => '0',
            )
        );
        if(isset($this->request->data['q']) && !empty($this->request->data['q'])){
            $conds['conditions']['InoutWarehouse.code'] = $this->request->data['q'];
        }
        if(isset($this->request->data['from']) && !empty($this->request->data['from'])){
            if(isset($this->request->data['to']) && !empty($this->request->data['to'])){
                $conds['conditions']['InoutWarehouse.created >='] = $this->request->data['from'].' 00:00:00';
                $conds['conditions']['InoutWarehouse.created <='] = $this->request->data['to'].' 23:59:59';
            }
        }

        if ($this->Session->read('Auth.User.group_id') != 1) {
            $conds['conditions']['InoutWarehouse.store_id'] = $this->Session->read('Auth.User.Store.id');
        }
        $conds['order'] = 'InoutWarehouse.created DESC';
        $this->Paginator->settings = $conds;

        $this->InoutWarehouse->recursive = 1;
        $this->set('inoutWarehouses', $this->Paginator->paginate());

        $this->status = array(
            'Chờ duyệt',
            'Đã nhập',
            'Đã huỷ',
        );
    }

    /**
     * view method
     *
     * @throws NotFoundException
     *
     * @param string $id
     *
     * @return void
     */
    public function admin_view($id = null, $action = 'view')
    {
        $showBtn = false;
        if ($action == 'in') $showBtn = true;

        if (!$this->InoutWarehouse->exists($id)) {
            throw new NotFoundException(__('Invalid inout warehouse'));
        }
        $options = array('conditions' => array('InoutWarehouse.' . $this->InoutWarehouse->primaryKey => $id));
        $inoutWarehouse = $this->InoutWarehouse->find('first', $options);
        if ($this->request->is(array('post', 'put'))) {
            debug($this->request->data);
            die;
        } else {
            $this->request->data = array('InoutWarehouse' => $inoutWarehouse['InoutWarehouse'], 'InoutWarehouseDetail' => $inoutWarehouse['InoutWarehouseDetail']);
        }
        $this->set(compact('inoutWarehouse'));
        $this->set(compact('showBtn'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add($type = 0)
    {
        if ($this->request->is('post')) {
            $cont = true;
            if ($type == 1) {
                if ($this->request->data['InoutWarehouse']['store_id'] == $this->request->data['InoutWarehouse']['store_receive_id']) {
                    $this->Session->setFlash(__('The inout warehouse could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
                    $cont = false;
                }
            }
            if ($cont) {
                if (isset($this->request->data['ProductList'])) {
                    $this->InoutWarehouse->create();
                    if (empty($this->request->data['InoutWarehouse']['code']))
                        $this->request->data['InoutWarehouse']['code'] = 'DN' . date("Ymdhis");
                    $summary = 0;
                    foreach ($this->request->data['ProductList'] as $pItem) {
                        $data = json_decode($pItem['Product']['data'], true);
                        $summary += $data['price'] * $pItem['Product']['qty'];
                    }
                    $this->request->data['InoutWarehouse']['total'] = $summary;
                    if ($this->InoutWarehouse->save($this->request->data)) {
                        $arrStore = array();

                        foreach ($this->request->data['ProductList'] as $pItem) {
                            $data = json_decode($pItem['Product']['data'], true);
                            $total = $data['price'] * $pItem['Product']['qty'];
                            $temp = array();
                            $temp['inout_warehouse_id'] = $this->InoutWarehouse->id;
                            $temp['product_id'] = $data['id'];
                            $temp['sku'] = $pItem['Product']['code'];
                            $temp['qty'] = $pItem['Product']['qty'];
                            $temp['price'] = $data['price'];
                            $temp['total'] = $total;
                            $temp['options'] = implode(',', json_decode($pItem['Product']['option']));
                            $temp['option_names'] = implode(',', json_decode($pItem['Product']['optionName']));
                            $temp['name'] = $data['name'];
                            $arrStore['InoutWarehouseDetail'][] = $temp;
                        }

                        $this->InoutWarehouse->InoutWarehouseDetail->saveMany($arrStore['InoutWarehouseDetail']);
                        $this->Session->setFlash(__('The inout warehouse has been saved.'), 'message', array('class' => 'alert-success'));
                        if ($type == 1)
                            return $this->redirect(array('action' => 'index'));
                        else
                            return $this->redirect(array('action' => 'in'));
                    } else {
                        $this->Session->setFlash(__('The inout warehouse could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
                    }
                } else {
                    $this->Session->setFlash(__('Vui lòng thêm hàng'), 'message', array('class' => 'alert-danger'));
                }
            }
        }
        $stores = $this->InoutWarehouse->Store->find('list');
        $customers = $this->InoutWarehouse->Customer->find('list');
        $this->loadModel('OptionGroup');
        $options = $this->OptionGroup->getOptions();
        $this->set(compact('stores', 'customers', 'type', 'options'));
    }

    public function admin_transferred()
    {
        $type = 1;
        if ($this->request->is('post')) {
            $cont = true;
            if ($this->request->data['InoutWarehouse']['store_id'] == $this->request->data['InoutWarehouse']['store_receive_id']) {
                $this->Session->setFlash(__('The inout warehouse could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
                $cont = false;
            }
            if ($cont) {
                if (isset($this->request->data['ProductList'])) {
                    $this->InoutWarehouse->create();
                    if (empty($this->request->data['InoutWarehouse']['code']))
                        $this->request->data['InoutWarehouse']['code'] = 'DN' . date("Ymdhis");
                    $summary = 0;
                    foreach ($this->request->data['ProductList'] as $pItem) {
                        $data = json_decode($pItem['Product']['data'], true);
                        $summary += $data['price'] * $pItem['Product']['qty'];
                    }
                    $this->request->data['InoutWarehouse']['total'] = $summary;
                    $this->request->data['InoutWarehouse']['status'] = 3;
                    if ($this->InoutWarehouse->save($this->request->data)) {
                        $arrStore = array();
                        $arrWarehouse = array();
                        foreach ($this->request->data['ProductList'] as $pItem) {
                            $data = json_decode($pItem['Product']['data'], true);
                            $total = $data['price'] * $pItem['Product']['qty'];
                            $temp = array();
                            $temp['inout_warehouse_id'] = $this->InoutWarehouse->id;
                            $temp['product_id'] = $data['id'];
                            $temp['sku'] = $pItem['Product']['code'];
                            $temp['qty'] = $pItem['Product']['qty'];
                            $temp['price'] = $data['price'];
                            $temp['total'] = $total;
                            $temp['options'] = $pItem['Product']['option'];
                            $temp['option_names'] = $pItem['Product']['optionName'];
                            $temp['name'] = $data['name'];
                            $arrStore['InoutWarehouseDetail'][] = $temp;

                            $temp2 = array();
                            $temp2['id'] = $pItem['Product']['warehouse'];
                            $temp2['qty'] = $pItem['Product']['limit'] - $pItem['Product']['qty'];
                            $arrWarehouse[] = $temp2;
                        }
                        $this->InoutWarehouse->InoutWarehouseDetail->saveMany($arrStore['InoutWarehouseDetail']);
                        $this->loadModel('Warehouse');
//                        $this->Warehouse->saveMany($arrWarehouse);
                        $this->Session->setFlash(__('The inout warehouse has been saved.'), 'message', array('class' => 'alert-success'));
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('The inout warehouse could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
                    }
                } else {
                    $this->Session->setFlash(__('Vui lòng thêm hàng'), 'message', array('class' => 'alert-danger'));
                }
            }
        }
        $stores = $this->InoutWarehouse->Store->find('list');
        $customers = $this->InoutWarehouse->Customer->find('list');
        $this->loadModel('OptionGroup');
        $options = $this->OptionGroup->getOptions();
        $this->set(compact('stores', 'customers', 'type', 'options'));
    }
    public function admin_do_transfer($id = null){
        if (!$this->InoutWarehouse->exists($id)) {
            throw new NotFoundException(__('Invalid inout warehouse'));
        }
        $options = array('conditions' => array('InoutWarehouse.' . $this->InoutWarehouse->primaryKey => $id));
        $data = $this->InoutWarehouse->find('first', $options);
        $data['InoutWarehouse']['status'] = '0';
        $products = Set::combine($data['InoutWarehouseDetail'],'{n}.sku','{n}.sku');

        $this->loadModel('Warehouse');

        $warehouse = $this->Warehouse->find('all',array(
            'fields'=>'Warehouse.id,Warehouse.code,Warehouse.qty',
            'conditions'=>array(
                'Warehouse.store_id' => $data['InoutWarehouse']['store_id'],
                'Warehouse.code' => $products
            )
        ));
        $warehouse = Set::classicExtract($warehouse,'{n}.Warehouse');
        $warehouse = Set::combine($warehouse,'{n}.code','{n}');
//        $warehouse = array(
//            '91010MX27' => array(
//                'id' => '1',
//                'code' => '91010MX27',
//                'qty' => '4'
//            ),
//            '6616DE2X' => array(
//                'id' => '51',
//                'code' => '6616DE2X',
//                'qty' => '1'
//            )
//        );
        foreach($data['InoutWarehouseDetail'] as $d){

            $old = $warehouse[$d['sku']]['qty'];
            $new = $d['qty'];

            if($new > $old){
                $this->Session->setFlash(__('Số lượng trong kho ít hơn số lượng cần chuyển.'), 'message', array('class' => 'alert-danger'));
                return $this->redirect(array('action' => 'change_transfer',$id));
            }
            $warehouse[$d['sku']]['qty'] = $old - $new;
        }
        if ($this->InoutWarehouse->save($data)) {
            $this->Warehouse->saveMany($warehouse);
            $this->Session->setFlash(__('The inout warehouse has been saved.'), 'message', array('class' => 'alert-success'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash(__('The inout warehouse could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    /**
     * edit method
     *
     * @throws NotFoundException
     *
     * @param string $id
     *
     * @return void
     */
    public function admin_change($id = null)
    {
//        debug($this->request);die;
        if (!$this->InoutWarehouse->exists($id)) {
            throw new NotFoundException(__('Invalid inout warehouse'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $storeData = array();
            $fullTotal = 0;
            if(isset($this->request->data['InoutWarehouseDetail']) && count($this->request->data['InoutWarehouseDetail'])){
                foreach($this->request->data['InoutWarehouseDetail'] as $detail){
                    $total = $detail['qty'] * $detail['price'];
                    $fullTotal+= $total;
                    $storeData[] = array(
                        'qty' => $detail['qty'],
                        'product_id' => $detail['product_id'],
                        'inout_warehouse_id' => $detail['inout_warehouse_id'],
                        'sku' => $detail['sku'],
                        'price' => $detail['price'],
                        'name' => $detail['name'],
                        'options' => $detail['options'],
                        'option_names' => $detail['option_names'],
                        'total' => $total,
                    );
                }
            }
            $this->request->data['InoutWarehouse']['total'] = $fullTotal;
            if ($this->InoutWarehouse->save($this->request->data)) {
                $this->InoutWarehouse->InoutWarehouseDetail->deleteAll(array('InoutWarehouseDetail.inout_warehouse_id' => $id), false);
                $this->InoutWarehouse->InoutWarehouseDetail->saveMany($storeData);
                $this->Session->setFlash(__('The inout warehouse has been saved.'), 'message', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'in'));
            } else {
                $this->Session->setFlash(__('The inout warehouse could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('InoutWarehouse.' . $this->InoutWarehouse->primaryKey => $id));
            $this->request->data = $this->InoutWarehouse->find('first', $options);
        }
        if($this->request->data['InoutWarehouse']['type'] == 1){
            return $this->redirect(array('action' => 'in'));
        }
        $stores = $this->InoutWarehouse->Store->find('list');
        $customers = $this->InoutWarehouse->Customer->find('list');
        $this->loadModel('OptionGroup');
        $options = $this->OptionGroup->getOptions();
        $this->set(compact('stores', 'customers', 'type', 'options'));
    }
    public function admin_change_transfer($id = null)
    {
//        debug($this->request);die;
        if (!$this->InoutWarehouse->exists($id)) {
            throw new NotFoundException(__('Invalid inout warehouse'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $storeData = array();
            $fullTotal = 0;
            if(isset($this->request->data['InoutWarehouseDetail']) && count($this->request->data['InoutWarehouseDetail'])){
                foreach($this->request->data['InoutWarehouseDetail'] as $detail){
                    $total = $detail['qty'] * $detail['price'];
                    $fullTotal+= $total;
                    $storeData[] = array(
                        'qty' => $detail['qty'],
                        'product_id' => $detail['product_id'],
                        'inout_warehouse_id' => $detail['inout_warehouse_id'],
                        'sku' => $detail['sku'],
                        'price' => $detail['price'],
                        'name' => $detail['name'],
                        'options' => $detail['options'],
                        'option_names' => $detail['option_names'],
                        'total' => $total,
                    );
                }
            }
            $this->request->data['InoutWarehouse']['total'] = $fullTotal;
            if ($this->InoutWarehouse->save($this->request->data)) {
                $this->InoutWarehouse->InoutWarehouseDetail->deleteAll(array('InoutWarehouseDetail.inout_warehouse_id' => $id), false);
                $this->InoutWarehouse->InoutWarehouseDetail->saveMany($storeData);
                $this->Session->setFlash(__('The inout warehouse has been saved.'), 'message', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The inout warehouse could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('InoutWarehouse.' . $this->InoutWarehouse->primaryKey => $id));
            $this->request->data = $this->InoutWarehouse->find('first', $options);
        }
        if($this->request->data['InoutWarehouse']['type'] == 0){
            return $this->redirect(array('action' => 'index'));
        }
        if($this->request->data['InoutWarehouse']['type'] == 1){
            $products = Set::combine($this->request->data['InoutWarehouseDetail'],'{n}.sku','{n}.sku');
            $this->loadModel('Warehouse');
            $limits = $this->Warehouse->find('list',array(
                'fields'=>'Warehouse.code,Warehouse.qty',
                'conditions'=>array(
                    'Warehouse.store_id' => $this->request->data['InoutWarehouse']['store_id'],
                    'Warehouse.code' => $products
                )
            ));
            $this->set(compact('limits'));
        }

        $stores = $this->InoutWarehouse->Store->find('list');
        $customers = $this->InoutWarehouse->Customer->find('list');
        $this->loadModel('OptionGroup');
        $options = $this->OptionGroup->getOptions();
        $this->set(compact('stores', 'customers', 'type', 'options'));
    }

    /**
     * approve method
     *
     * @throws NotFoundException
     *
     * @param string $id
     *
     * @return void
     */
    public function admin_approve($id = null)
    {
        if ($this->InoutWarehouse->exists($id)) {
            $data = $this->InoutWarehouse->find('first', array(
                'conditions' => array(
                    'InoutWarehouse.id' => $id
                )
            ));
            $approvedata = $data['InoutWarehouse'];
            $approvedata['approved'] = date("Y-m-d h:i:s");
            $approvedata['approved_by'] = $this->Session->read('Auth.User.id');
            $approvedata['status'] = 1;
//				$inoutWarehouse = $data['InoutWarehouse'];
//				unset($inoutWarehouse['id']);
//				$inoutWarehouse['parent_id'] = $data['InoutWarehouse']['id'];
//				$inoutWarehouse['type'] = 1;
            $inoutWarehouseDetail = $data['InoutWarehouseDetail'];
//				$inoutWarehouseDetail_tmp = $data['InoutWarehouseDetail'];
//				$inoutWarehouseDetail=array();
//				foreach($inoutWarehouseDetail_tmp as $key=>$val){
//					unset($val['id']);
//					$inoutWarehouseDetail[] = $val;
//				}

//				if ($this->InoutWarehouse->save ($inoutWarehouse)) {
//				if (true) {
            $arrStore = array();
            foreach ($inoutWarehouseDetail as $item) {
                $temp = $item;
                $temp['inout_warehouse_id'] = $this->InoutWarehouse->id;
                $arrStore['InoutWarehouseDetail'][] = $temp;
            };
//					$this->InoutWarehouse->InoutWarehouseDetail->saveMany($arrStore['InoutWarehouseDetail']);
            $this->loadModel('Warehouse');
            $warehouse = array();
            $storeId = $this->Session->read('Auth.User.store_id');

            foreach ($arrStore['InoutWarehouseDetail'] as $item) {
                $oldData = $this->Warehouse->find('first', array(
                    'conditions' => array(
                        'Warehouse.store_id' => $storeId,
                        'Warehouse.product_id' => $item['product_id'],
                        'Warehouse.options' => $item['options']
                    ),
                    'recursive' => -1
                ));

                $t = array(
                    'store_id' => $storeId,
                    'product_id' => $item['product_id'],
                    'options' => $item['options'],
                    'price' => $item['price'],
                    'code' => $item['sku'],
                );
                if (isset($oldData['Warehouse'])) {
                    $t['id'] = $oldData['Warehouse']['id'];
                    $t['qty'] = $item['qty'] + $oldData['Warehouse']['qty'];
                } else {
                    $t['qty'] = $item['qty'];
                }
                $warehouse[] = $t;
//						debug($oldData);

            }
            $this->Warehouse->saveMany($warehouse);
//					die;
            $this->InoutWarehouse->save($approvedata);


            $this->Session->setFlash(__('The inout warehouse has been saved.'), 'message', array('class' => 'alert-success'));

            return $this->redirect(array('action' => 'in'));
//				} else {
//					$this->Session->setFlash (__ ('The inout warehouse could not be saved. Please, try again.'));
//
//					return $this->redirect (array ('action' => 'view', $id, 'in'));
//				}
        }
//		die;
    }

    public function admin_approve_transfer($id = null)
    {
        if ($this->InoutWarehouse->exists($id)) {
            $data = $this->InoutWarehouse->find('first', array(
                'conditions' => array(
                    'InoutWarehouse.id' => $id
                )
            ));
            $approvedata = $data['InoutWarehouse'];
            $approvedata['approved'] = date("Y-m-d h:i:s");
            $approvedata['approved_by'] = $this->Session->read('Auth.User.id');
            $approvedata['status'] = 1;
            $this->loadModel('Warehouse');
            $warehouse = array();
            $storeId = $this->request->data['InoutWarehouse']['store_receive_id'];

            foreach ($this->request->data['InoutWarehouseDetail'] as $item) {
                $oldData = $this->Warehouse->find('first', array(
                    'conditions' => array(
                        'Warehouse.store_id' => $storeId,
                        'Warehouse.product_id' => $item['product_id'],
                        'Warehouse.options' => $item['options']
                    ),
                    'recursive' => -1
                ));

                $t = array(
                    'store_id' => $storeId,
                    'product_id' => $item['product_id'],
                    'options' => $item['options'],
                    'price' => $item['price'],
                );
                if (isset($oldData['Warehouse'])) {
                    $t['id'] = $oldData['Warehouse']['id'];
                    $t['qty'] = $item['qty_received'] + $oldData['Warehouse']['qty'];
                } else {
                    $t['qty'] = $item['qty_received'];
                }
                $warehouse[] = $t;
            }
            $this->Warehouse->saveMany($warehouse);
            $this->InoutWarehouse->save($approvedata);
            $this->InoutWarehouse->InoutWarehouseDetail->saveMany($this->request->data['InoutWarehouseDetail']);
            $this->Session->setFlash(__('The inout warehouse has been saved.'), 'message', array('class' => 'alert-success'));
            return $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     *
     * @param string $id
     *
     * @return void
     */
    public function admin_delete($id = null)
    {
//        $this->InoutWarehouse->id = $id;
//        if (!$this->InoutWarehouse->exists()) {
//            throw new NotFoundException(__('Invalid inout warehouse'));
//        }
//        $this->request->allowMethod('post', 'delete');
//        if ($this->InoutWarehouse->delete()) {
//            $this->Session->setFlash(__('The inout warehouse has been deleted.'));
//        } else {
//            $this->Session->setFlash(__('The inout warehouse could not be deleted. Please, try again.'));
//        }
//
//        return $this->redirect(array('action' => 'index'));
    }
    public function admin_cancel($id = null){
        $saveData = array('InoutWarehouse'=>array(
            'status'=>2
        ));
        $this->InoutWarehouse->id = $id;
        $this->InoutWarehouse->save($saveData);
        return $this->redirect(array('action' => 'in'));
    }
    public function admin_cancel_transfer($id = null){
        $this->InoutWarehouse->id = $id;
        if (!$this->InoutWarehouse->exists()) {
            throw new NotFoundException(__('Invalid inout warehouse'));
        }
        $data = $this->InoutWarehouse->find('first', array(
            'conditions' => array(
                'InoutWarehouse.id' => $id
            )
        ));
        //0,1,2,3
        if(count($data)>0){
           if($data['InoutWarehouse']['status'] == 0){
               if( $this->InoutWarehouse->save(array(
                   'InoutWarehouse' =>array(
                       'id' => $id,
                       'status' => 2
                   )
               ))){
                   $warehouse = array();
                   $this->loadModel('Warehouse');
                   foreach($data['InoutWarehouseDetail'] as $d){
                       $oldData = $this->Warehouse->find('first', array(
                           'conditions' => array(
                               'Warehouse.store_id' => $data['Store']['id'],
                               'Warehouse.product_id' => $d['product_id'],
                               'Warehouse.options' => $d['options']
                           ),
                           'recursive' => -1
                       ));

                       $t = array();
                       if (isset($oldData['Warehouse'])) {
                           $t['id'] = $oldData['Warehouse']['id'];
                           $t['qty'] = $d['qty'] + $oldData['Warehouse']['qty'];
                       }
                       $warehouse[] = $t;
                   }
                   $this->Warehouse->saveMany($warehouse);
               }
           }else if($data['InoutWarehouse']['status'] == 3){
               $this->InoutWarehouse->save(array(
                   'InoutWarehouse' =>array(
                       'id' => $id,
                       'status' => 2
                   )
               ));
           }
        }
        return $this->redirect(array('action' => 'index'));
    }
}
