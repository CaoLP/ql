<?php
App::uses('AppController', 'Controller');
/**
 * Reports Controller
 *
 * @property Reex $Reex
 * @property PaginatorComponent $Paginator
 */
class ReportsController extends AppController
{
    public $title_for_layout = 'Thống kê';
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function admin_orders()
    {
        $this->set('title_for_layout','Bán hàng và thu tiền theo ngày');
        $options = array();
        if(isset($this->request->data['from']) && isset($this->request->data['to'])){
            $options['conditions']['Order.created >='] = $this->request->data['from'].' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'].' 23:59:59';
        }else if(isset($this->request->data['from'])){
            $options['conditions']['Order.created >='] = $this->request->data['from'].' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['from'].' 23:59:59';
        }else if(isset($this->request->data['to'])){
            $options['conditions']['Order.created >='] = $this->request->data['to'].' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'].' 23:59:59';
        }else{
            $this->request->data['from'] = date('Y-m-d');
            $this->request->data['to'] = date('Y-m-d');
            $options['conditions']['Order.created >='] = $this->request->data['from'].' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'].' 23:59:59';
        }
        if(isset($this->request->data['filter'])){
            $filter = $this->request->data['filter'];
        }else{
            $filter = 'qty';
        }
        if(isset($this->request->data['side'])){
            $side = $this->request->data['side'];
        }else{
            $side = 'desc';
        }
        if(isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])){
            $options['conditions']['Order.store_id'] = $this->request->data['store_id'];
        }
        $this->loadModel('Order');
        $this->loadModel('Store');
        $orders = $this->Order->getReportOrder($options);
        $orders = Set::combine($orders, '{n}.Order.id', '{n}.Order', '{n}.Order.store_id');
        $stores = $this->Store->find('list');
        $this->set(compact('orders', 'stores'));
//        (int) 7 => array(
//        'Order' => array(
//            'id' => '10',
//            'code' => 'BL07122014051212',
//            'customer_id' => '1',
//            'user_id' => '0',
//            'store_id' => '3',
//            'promote_id' => null,
//            'promote_type' => null,
//            'promote_value' => '0',
//            'total' => '850000',
//            'total_promote' => '0',
//            'amount' => '850000',
//            'receive' => '850000',
//            'refund' => '0',
//            'ship' => '0',
//            'ship_increment_price' => '0',
//            'ship_name' => null,
//            'ship_address' => null,
//            'ship_address_alt' => null,
//            'ship_district' => null,
//            'ship_city' => null,
//            'ship_phone' => null,
//            'status' => '1',
//            'created' => '2014-12-07 17:56:12',
//            'created_by' => '16',
//            'updated' => '2014-12-07 17:56:12',
//            'updated_by' => '16'
//        )
//    ),
    }

    public function admin_products()
    {
        $this->set('title_for_layout','Báo cáo chi tiết hàng hóa bán ra');
        $options = array();
        if(isset($this->request->data['from']) && isset($this->request->data['to'])){
            $options['conditions']['Order.created >='] = $this->request->data['from'].' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'].' 23:59:59';
        }else if(isset($this->request->data['from'])){
            $options['conditions']['Order.created >='] = $this->request->data['from'].' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['from'].' 23:59:59';
        }else if(isset($this->request->data['to'])){
            $options['conditions']['Order.created >='] = $this->request->data['to'].' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'].' 23:59:59';
        }else{
            $this->request->data['from'] = date('Y-m-d');
            $this->request->data['to'] = date('Y-m-d');
            $options['conditions']['Order.created >='] = $this->request->data['from'].' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'].' 23:59:59';
        }
        if(isset($this->request->data['filter'])){
            $filter = $this->request->data['filter'];
        }else{
            $filter = 'qty';
        }
        if(isset($this->request->data['side'])){
            $side = $this->request->data['side'];
        }else{
            $side = 'desc';
        }
        if(isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])){
            $options['conditions']['Order.store_id'] = $this->request->data['store_id'];
        }
        $this->loadModel('Order');
        $this->loadModel('Store');
        $orders = $this->Order->getReportOrderDetails($options);
        $orders = Set::combine($orders, '{n}.Order.id', '{n}.OrderDetail', '{n}.Order.store_id');
//        array(
//            store_id => array(
//                product_id =>array(
//                      'product_id' => '7',
//                      'sku' => '2222',
//                      'price' => '340000',
//                      'name' => 'Quần jean',
//                      'qty' => '1',
//                  )
//              )
//           );
        $temps = array();
        foreach ($orders as $key_t=>$order) {
            $products = array();
            foreach ($order as $orderDetails) {
                foreach ($orderDetails as $item) {
                   if(isset($products[$item['product_id']])){
                       $old = $products[$item['product_id']];
                       $products[$item['product_id']]['qty'] = $old['qty'] + $item['qty'];
                   }else{
                       $products[$item['product_id']] = array(
                           'product_id' =>$item['product_id'] ,
                           'sku' =>$item['sku'] ,
                           'name' =>$item['name'] ,
                           'price' =>$item['price'] ,
                           'qty' =>$item['qty'] ,
                       );
                   }
                }
            }
            $temps[$key_t] = $products;
        }
        $orders = $temps;
        $stores = $this->Store->find('list');


        $this->set(compact('orders', 'stores', 'filter', 'side'));
    }

    public function admin_payments()
    {

    }

    public function admin_product_in_warehouse()
    {

    }

    public function admin_product_underlimited()
    {

    }

    public function admin_debtors()
    {

    }

    public function admin_warehouse()
    {

    }

}
