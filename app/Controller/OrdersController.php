<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 */
class OrdersController extends AppController
{

    public $title_for_layout = 'Đơn hàng';
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function  beforeRender()
    {
        $status = array(
            'Đang duyệt',
            'Đã hoàn tất',
            'Đã huỷ',
        );
        $this->set('statuses', $status);
        parent::beforeRender();
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_index()
    {
        $settings = array();

        $this->Order->recursive = 0;
        if ($this->request->is('post')) {

//            array(
//                'optionsRadios' => '1',
//                'q' => '',
//                'store_id' => '',
//                'from' => '',
//                'to' => ''
//            )

            if(isset($this->request->data['q'])){
                $input =$this->request->data['q'];
                $settings['conditions']['Order.code like'] = '%' . $input . '%';
            }
            if($this->Session->read('Auth.User.group_id') == 1){
                if(isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])){
                    $settings['conditions']['Order.store_id'] = $this->request->data['store_id'];
                }
            }else{
                $settings['conditions']['Order.store_id'] = $this->Session->read('Auth.User.store_id');
            }
            if(isset($this->request->data['status']) && $this->request->data['status'] !=''){
                $settings['conditions']['Order.status'] = $this->request->data['status'];
            }else{
                $settings['conditions']['Order.status'] = 1;
            }

            if(isset($this->request->data['optionsRadios']) && !empty($this->request->data['optionsRadios'])){
                switch ($this->request->data['optionsRadios']){
                    case 2:
                        $settings['conditions']['Order.created >='] = date('Y-m-d').' 00:00:00';
                        $settings['conditions']['Order.created <='] = date('Y-m-d').' 23:59:59';
                        break;
                    case 3:
                        $first_date =  (new DateTime())->modify('this week')->format('Y-m-d');
                        $last_date =   (new DateTime())->modify('this week +6 days')->format('Y-m-d');

                        $settings['conditions']['Order.created >='] = $first_date.' 00:00:00';
                        $settings['conditions']['Order.created <='] = $last_date.' 23:59:59';
                        break;
                    case 4:
                        $settings['conditions']['Order.created >='] = date('Y-m-01').' 00:00:00';
                        $settings['conditions']['Order.created <='] = date('Y-m-t').' 23:59:59';
                        break;
                    case 5:
                        if(!empty($this->request->data['from']) && !empty($this->request->data['to'])){
                        $settings['conditions']['Order.created >='] = $this->request->data['from'].' 00:00:00';
                        $settings['conditions']['Order.created <='] = $this->request->data['to'].' 23:59:59';
                        }
                        break;
                    case 1:
                    default:
                        break;
                }
            }
            $settings['order'] = 'Order.created DESC';
            $this->Session->write('Order.paginate',$settings);
            $this->Session->write('Order.request.data',$this->request->data);
            return $this->redirect(array('action'=>'index'));
        }
        if($this->Session->check('Order.paginate')){
            $this->paginate = $this->Session->read('Order.paginate');
        }else{
            $this->paginate = array(
                'conditions'=>array(
                    'Order.store_id'=> $this->Session->read('Auth.User.store_id')
                ),
                'order' => 'Order.created DESC',
            );
        }
        if($this->Session->check('Order.request.data')){
            $this->request->data = $this->Session->read('Order.request.data');
        }
        $this->set('orders', $this->Paginator->paginate());
        $this->loadModel('Store');
        $stores = $this->Store->find('list');
        $this->set(compact('stores'));
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
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        if ($this->request->is('post')) {


        }
        $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
        $this->request->data = $this->Order->find('first', $options);
        $customers = $this->Order->Customer->find('list');
        $promoteData = $this->Order->Promote->find('all', array('recursive' => -1));
        $options = $this->Order->OrderDetail->Product->ProductOption->Option->find('list');
        $promotes = Set::combine($promoteData, '{n}.Promote.id', '{n}.Promote.name');
        $promoteData = Set::combine($promoteData, '{n}.Promote.id', '{n}');
        $this->layout = 'order';
        $this->set(compact('customers', 'users', 'promotes', 'promoteData', 'options'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            if(isset($this->request->data['OrderDetail'])){
                $this->Order->create();
                $total = 0;
                $amount = 0;
                $order_detail = $this->request->data['OrderDetail'];
                foreach ($order_detail as $detail) {
                    $data = json_decode($detail['data'], true);
                    $total += $detail['qty'] * $data['price'];
                }
                if(empty($this->request->data['Order']['promote_value'])){
                    $this->request->data['Order']['promote_value'] = 0;
                }
                $promote = $this->request->data['Order']['promote_value'];
                if ($this->request->data['Order']['promote_type'] == 1) {
                    $promote = $total * ($promote / 100);
                }
                $amount = $total - $promote;

                if( empty($this->request->data['Order']['customer_id']) || !is_nan($this->request->data['Order']['customer_id'])){
                    $this->request->data['Order']['customer_id'] = 1;
                }
                if(empty($this->request->data['Order']['receive'])){
                    $this->Session->setFlash(__('Vui lòng điền số tiền nhận từ khách.'), 'message', array('class' => 'alert-danger'));
                    return $this->redirect(array('action' => 'add'));
                }
                if(empty($this->request->data['Order']['refund'])){
                    $this->request->data['Order']['refund'] = 0;
                }
                $orCode = 'BL'.date('dmYhms');
                $saveData = array(
                    'Order' => array(
                        'customer_id' => $this->request->data['Order']['customer_id'],
                        'promote_id' => $this->request->data['Order']['promote_id'],
                        'promote_value' => $this->request->data['Order']['promote_value'],
                        'promote_type' => $this->request->data['Order']['promote_type'],
                        'note' => $this->request->data['Order']['note'],
                        'store_id' => $this->request->data['Order']['store_id'],
                        'total' => $total,
                        'status' => 1,
                        'code' => $orCode,
                        'total_promote' => $promote,
                        'amount' => $amount,
                        'receive' => str_replace(',', '', $this->request->data['Order']['receive']),
                        'refund' => str_replace(',', '', $this->request->data['Order']['refund']),
                    )
                );

                if ($this->Order->save($saveData)) {
                    $storeDetail = array();

                    $id = $this->Order->id;
                    //`id`, `order_id`, `product_id`, `name`, `price`, `sku`, `qty`
                    $this->loadModel('Warehouse');
                    $warehouse = array();
                    foreach ($order_detail as $detail) {
                        $data = json_decode($detail['data'], true);
                        $storeDetail[] = array(
                            'order_id' => $id,
                            'product_id' => $data['id'],
                            'name' => $data['name'],
                            'price' => $detail['mod_price'],
                            'sku' => $data['sku'],
                            'qty' => $detail['qty'],
                            'code' => $data['code'],
                            'product_options' => $data['options'],
                            'data' => $detail['data'],
                        );
                        $oldData = $this->Warehouse->find('first', array(
                            'conditions' => array(
                                'Warehouse.store_id' => $this->request->data['Order']['store_id'],
                                'Warehouse.product_id' => $data['id'],
                                'Warehouse.options' => $data['options']
                            ),
                            'recursive' => -1
                        ));

                        $t = array();
                        if (isset($oldData['Warehouse'])) {
                            $t['id'] = $oldData['Warehouse']['id'];
                            $t['qty'] = $oldData['Warehouse']['qty']-$detail['qty'];
                        }
                        $warehouse[] = $t;
                    }
                    $this->Order->OrderDetail->saveMany($storeDetail);
                    $this->Warehouse->saveMany($warehouse);
                    $this->Session->setFlash(__('The order has been saved.'), 'message', array('class' => 'alert-success'));
                    $this->Session->delete('Cart');



                    $this->loadModel('OrderLog');

                    $this->OrderLog->save(array(
                        'OrderLog'=>array(
                            'order_id' => $id,
                            'type' => '0',
                            'data' => json_encode(array(
                                'Order' =>$saveData,
                                'OrderDetail' => $order_detail
                            ))
                        )
                    ));


                    $storeName = $this->Session->read('Auth.User.Store.name');

                    $message = '[<strong>Đơn hàng</strong>]['.$storeName.'] Đơn hàng [<a href="javascript:;" data-type="order" data-order="'.$orCode.'">'.$orCode.'</a>]'.
                        ' đã được tạo bởi <strong>'.$this->Session->read('Auth.User.name').'</strong>';

                    $this->loadModel('ActionLog');
                    $this->ActionLog->save(array(
                        'ActionLog'=>array(
                            'message' => $message
                        )
                    ));

                    return $this->redirect(array('action' => 'view',$id));
                } else {
                    $this->Session->setFlash(__('The order could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
                }
            }else{
                $this->Session->setFlash(__('Vui lòng nhập hàng.'), 'message', array('class' => 'alert-danger'));
            }
        }
        if($this->Session->read('Cart')){
            $this->request->data =  $this->Session->read('Cart');
        }
        $this->loadModel('Category');

        $this->loadModel('Warehouse');
        $warehouse = $this->Warehouse->filterWarehouseData($this->Session->read('Auth.User.store_id'));

        $customers = $this->Order->Customer->find('list');
        $customersl = $customers;
        $temp = array();
        foreach ($customers as $key => $val) {
            $temp[] = array('value' => $key, 'label' => $val);
        }
        $customers = $temp;
        $promoteData = $this->Order->Promote->find('all', array('recursive' => -1));
        $categories = $this->Category->find('list');
        $promotes = Set::combine($promoteData, '{n}.Promote.id', '{n}.Promote.name');
        $promoteData = Set::combine($promoteData, '{n}.Promote.id', '{n}');
        $this->layout = 'order';
        $this->set(compact('categories','customers', 'users', 'promotes', 'promoteData','customersl','warehouse'));
    }
    public function admin_save_cart(){
        if( empty($this->request->data['Order']['customer_id']) || !is_nan($this->request->data['Order']['customer_id'])){
            $this->request->data['Order']['customer_id'] = 1;
        }
        if(isset($this->request->data['OrderDetail'])){
            $temp = array();
            foreach($this->request->data['OrderDetail'] as $key=>$detail){
                $data = json_decode($detail['data'],true);
                $data['mod_price'] = $detail['mod_price'];
                $temp[$key]['mod_price'] = $detail['mod_price'];
                $temp[$key]['qty'] = $detail['qty'];
                $temp[$key]['data'] = json_encode($data);
            }
            $this->request->data['OrderDetail'] = $temp;
            debug($this->request->data['OrderDetail']);
        }
        $this->Session->write('Cart',$this->request->data);
        die;
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
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $total = 0;
            $amount = 0;
            $order_detail = $this->request->data['OrderDetail'];
            foreach ($order_detail as $detail) {
                $data = json_decode($detail['data'], true);
                $total += $detail['qty'] * $data['price'];
            }
            $promote = $this->request->data['Order']['promote_value'];
            if ($this->request->data['Order']['promote_type'] == 1) {
                $promote = $total * ($promote / 100);
            }
            $amount = $total - $promote;
            $id = $this->request->data['Order']['id'];
            $saveData = array(
                'Order' => array(
                    'id' => $this->request->data['Order']['id'],
                    'customer_id' => $this->request->data['Order']['customer_id'],
                    'promote_id' => $this->request->data['Order']['promote_id'],
                    'promote_value' => $this->request->data['Order']['promote_value'],
                    'promote_type' => $this->request->data['Order']['promote_type'],
                    'note' => $this->request->data['Order']['note'],
                    'store_id' => $this->request->data['Order']['store_id'],
                    'total' => $total,
                    'code' => $this->request->data['Order']['code'],
                    'total_promote' => $promote,
                    'status' => 1,
                    'amount' => $amount,
                    'receive' => str_replace(',', '', $this->request->data['Order']['receive']),
                    'refund' => str_replace(',', '', $this->request->data['Order']['refund']),
                )
            );
            if ($this->Order->save($saveData)) {
                $this->Order->OrderDetail->deleteAll(array('OrderDetail.order_id' => $id), false);
                $storeDetail = array();

                //`id`, `order_id`, `product_id`, `name`, `price`, `sku`, `qty`
                foreach ($order_detail as $detail) {
                    $data = json_decode($detail['data'], true);
                    $storeDetail[] = array(
                        'order_id' => $id,
                        'product_id' => $data['id'],
                        'name' => $data['name'],
                        'price' => $detail['mod_price'],
                        'sku' => $data['sku'],
                        'qty' => $detail['qty'],
                        'code' => $data['code'],
                        'product_options' => $data['options'],
                        'data' => $detail['data'],
                    );
                }
                $this->Order->OrderDetail->saveMany($storeDetail);
                $this->Session->setFlash(__('The order has been saved.'), 'message', array('class' => 'alert-success'));
                $this->Session->delete('Cart');

                $this->loadModel('OrderLog');

                $this->OrderLog->save(array(
                    'OrderLog'=>array(
                        'order_id' => $this->request->data['Order']['id'],
                        'type' => '1',
                        'data' => json_encode(array(
                            'Order' =>$saveData,
                            'OrderDetail' => $order_detail
                        ))
                    )
                ));
                $orCode = $this->request->data['Order']['code'];

                $message = '[<strong>Đơn hàng</strong>]Đơn hàng [<a href="javascript:;" data-type="order" data-order="'.$orCode.'">'.$orCode.'</a>]'.
                    ' đã thay đổi bởi <strong>'.$this->Session->read('Auth.User.name').'</strong>';

                $this->loadModel('ActionLog');
                $this->ActionLog->save(array(
                    'ActionLog'=>array(
                        'message' => $message
                    )
                ));


                return $this->redirect(array('action' => 'view',$id));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'), 'message', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
            $this->request->data = $this->Order->find('first', $options);
        }
        $customers = $this->Order->Customer->find('list');
        $customersl = $customers;
        $temp = array();
        foreach ($customers as $key => $val) {
            $temp[] = array('value' => $key, 'label' => $val);
        }
        $customers = $temp;
        $promoteData = $this->Order->Promote->find('all', array('recursive' => -1));
        $options = $this->Order->OrderDetail->Product->ProductOption->Option->find('list');
        $promotes = Set::combine($promoteData, '{n}.Promote.id', '{n}.Promote.name');
        $promoteData = Set::combine($promoteData, '{n}.Promote.id', '{n}');
        $this->layout = 'order';
        $this->set(compact('customers', 'users', 'promotes', 'promoteData', 'options', 'customersl'));
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
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException(__('Invalid order'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Order->delete()) {
            $this->Session->setFlash(__('The order has been deleted.'));
        } else {
            $this->Session->setFlash(__('The order could not be deleted. Please, try again.'), 'message', array('class' => 'alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_change(){

    }
    public function admin_cancel($id = null){
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException(__('Invalid order'));
        }
        $data = $this->Order->find('first', array(
            'conditions' => array(
                'Order.id' => $id
            )
        ));
        if(count($data)>0){
                if( $this->Order->save(array(
                    'Order' =>array(
                        'id' => $id,
                        'status' => 2
                    )
                ))){
                    $warehouse = array();
                    $this->loadModel('Warehouse');
                    foreach($data['OrderDetail'] as $d){
                        $oldData = $this->Warehouse->find('first', array(
                            'conditions' => array(
                                'Warehouse.store_id' => $data['Store']['id'],
                                'Warehouse.product_id' => $d['product_id'],
                                'Warehouse.options' => $d['product_options']
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

                    $orCode = $data['Order']['code'];

                    $message = 'Đơn hàng [<a href="javascript:;" data-type="order" data-order="'.$orCode.'">'.$orCode.'</a>]'.
                     ' đã bị huỷ bởi <strong>'.$this->Session->read('Auth.User.name').'</strong>';

                    $this->loadModel('ActionLog');
                    $this->ActionLog->save(array(
                        'ActionLog'=>array(
                            'message' => $message
                        )
                    ));
                }
        }
        return $this->redirect(array('action' => 'index'));
    }
}
