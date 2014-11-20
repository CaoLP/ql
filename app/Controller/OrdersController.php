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
        $this->Order->recursive = 0;
        $this->set('orders', $this->Paginator->paginate());
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

            $this->Order->create();
            $total = 0;
            $amount = 0;
            $order_detail = $this->request->data['OrderDetails'];
            foreach ($order_detail as $detail) {
                $data = json_decode($detail['data'], true);
                $total += $detail['qty'] * $data['price'];
            }
            $promote = $this->request->data['Order']['promote_value'];
            if ($this->request->data['Order']['promote_type'] == 1) {
                $promote = $total * ($promote / 100);
            }
            $amount = $total - $promote;
            $saveData = array(
                'Order' => array(
                    'customer_id' => $this->request->data['Order']['customer_id'],
                    'promote_id' => $this->request->data['Order']['promote_id'],
                    'promote_value' => $this->request->data['Order']['promote_value'],
                    'promote_type' => $this->request->data['Order']['promote_type'],
                    'note' => $this->request->data['Order']['note'],
                    'store_id' => $this->request->data['Order']['store_id'],
                    'total' => $total,
                    'code' => 'BL'.date('dmYhms'),
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

                foreach ($order_detail as $detail) {
                    $data = json_decode($detail['data'], true);
                    $storeDetail[] = array(
                        'order_id' => $id,
                        'product_id' => $data['id'],
                        'name' => $data['name'],
                        'price' => $data['price'],
                        'sku' => $data['sku'],
                        'qty' => $detail['qty'],
                        'code' => $data['code'],
                        'product_options' => $data['options'],
                    );
                }
                $this->Order->OrderDetail->saveMany($storeDetail);
                $this->Session->setFlash(__('The order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Order->Customer->find('list');
        $customersl = $customers;
        $temp = array();
        foreach ($customers as $key => $val) {
            $temp[] = array('value' => $key, 'label' => $val);
        }
        $customers = $temp;
        $promoteData = $this->Order->Promote->find('all', array('recursive' => -1));
        $promotes = Set::combine($promoteData, '{n}.Promote.id', '{n}.Promote.name');
        $promoteData = Set::combine($promoteData, '{n}.Promote.id', '{n}');
        $this->layout = 'order';
        $this->set(compact('customers', 'users', 'promotes', 'promoteData','customersl'));
    }
    public function admin_save_cart(){

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
            if ($this->Order->save($this->request->data)) {
                $this->Session->setFlash(__('The order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'));
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
            $this->Session->setFlash(__('The order could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
