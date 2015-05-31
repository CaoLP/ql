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

        $options['conditions']['Order.type'] = 0;

        $this->loadModel('Order');
        $this->loadModel('Store');
        $orders = $this->Order->getReportOrder($options);
        $orders = Set::combine($orders, '{n}.Order.id', '{n}.Order', '{n}.Order.store_id');
        $stores = $this->Store->find('list');
        $this->loadModel('Customer');
        $customers = $this->Customer->find('all',array(
            'fields' => 'id,name,phone',
            'recursive'=>-1
        ));
        $customers = Set::combine($customers,'{n}.Customer.id','{n}.Customer');
        $this->set(compact('orders', 'stores','customers'));
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

        $options['conditions']['Order.type'] = 0;

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
        $this->set('title_for_layout','Báo cáo thống kê lợi nhuận');
        $conditions = array();
        $store_id = 1;
        $summary = array(
            'in_price'=> 0,
            'out_price'=> 0,
            ''=> 0,
            ''=> 0,
            ''=> 0,
        );
        $date = array(date('Y-m-01 00:00'),date('Y-m-t 23:59'));
        if(isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])){
            $store_id = $this->request->data['store_id'];
            $conditions['Warehouse.store_id'] = $store_id;
        }
        if(isset($this->request->data['from']) && isset($this->request->data['to'])){
            $date = array(
                $this->request->data['from'].' 00:00:00',
                $this->request->data['to'].' 23:59:59'
            );
        }else if(isset($this->request->data['from'])){
            $date = array(
                $this->request->data['from'].' 00:00:00',
                $this->request->data['from'].' 23:59:59'
            );
        }else if(isset($this->request->data['to'])){
            $date = array(
                $this->request->data['to'].' 00:00:00',
                $this->request->data['to'].' 23:59:59'
            );
        }
        $this->loadModel('Warehouse');
        $products = $this->Warehouse->find('all', array(
            'fields' => array(
                'Warehouse.product_id',
                'Sum(Warehouse.qty) as total',
                'Product.name' ,
                'Product.sku',
                'Product.price',
                'Product.retail_price',
                'Product.source_price',
            ),
            'recursive' => 1,
            'conditions' => $conditions,
            'group' => array('Warehouse.product_id'),
            'order' => array('total' => 'desc'),
        ));
        $array_rebuild = array();
        $this->loadModel('Store');
        $stores = $this->Store->find('list');
        $this->loadModel('OrderDetail');
        $order_products = $this->OrderDetail->find('all',array(
            'fields'=>array(
                'OrderDetail.product_id',
                'Sum(OrderDetail.qty) as qty',
                'Sum(OrderDetail.qty * OrderDetail.price) as price',
            ),
           'conditions' => array(
               'Order.created between ? and ?' => $date,
               'Order.status' => 1,
               'Order.store_id' => $store_id,
           ),
            'group' => array(
                'OrderDetail.product_id'
            )
        ));
        $order_products = Set::combine($order_products,'{n}.OrderDetail.product_id','{n}.0');
//        debug($order_products);die;

        $this->loadModel('InoutWarehouseDetail');
        $in = $this->InoutWarehouseDetail->find('all', array(
            'fields'=>array(
                'InoutWarehouseDetail.product_id',
                'Sum(InoutWarehouseDetail.qty) as qty',
                'Sum(InoutWarehouseDetail.qty * InoutWarehouseDetail.price) as price',
            ),
            'conditions' => array(
                'InoutWarehouse.approved between ? and ?' => $date,
                'InoutWarehouse.status' => 1,
                'InoutWarehouse.type' => 0,
                'InoutWarehouse.store_id' => $store_id,
            ),
            'group' => array(
                'InoutWarehouseDetail.product_id'
            )
        ));
        $in = Set::combine($in,'{n}.InoutWarehouseDetail.product_id','{n}.0');
        $out = $this->InoutWarehouseDetail->find('all', array(
            'fields'=>array(
                'InoutWarehouseDetail.product_id',
                'Sum(InoutWarehouseDetail.qty_received) as qty',
                'Sum(InoutWarehouseDetail.qty_received * InoutWarehouseDetail.price) as price',
            ),
            'conditions' => array(
                'InoutWarehouse.approved between ? and ?' => $date,
                'InoutWarehouse.status' => 1,
                'InoutWarehouse.type' => 1,
                'InoutWarehouse.store_id' => $store_id,
            ),
            'group' => array(
                'InoutWarehouseDetail.product_id'
            )
        ));
        $out = Set::combine($out,'{n}.InoutWarehouseDetail.product_id','{n}.0');
        foreach($products as $k=>$p){
            $array_rebuild[$p['Warehouse']['product_id']] = array(
                'code' => $p['Product']['sku'],
                'name' => $p['Product']['name'],
                'price'=> $p['Product']['price'],
                'retail_price'=> $p['Product']['retail_price'],
                'source_price'=> $p['Product']['source_price'],
                'before_total'=> 0,
                'in_qty'=> 0,
                'in_price'=> 0,
                'out_qty'=> 0,
                'out_price'=> 0,
                'sale_qty'=> 0,
                'sale_promote'=> 0,
                'sale_price'=> 0,
                'after_total' => $p[0]['total'],
                'profit'=> 0,
            );
            if(isset($order_products[$p['Warehouse']['product_id']])){
                $array_rebuild[$p['Warehouse']['product_id']]['sale_qty'] = $order_products[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['sale_price'] = $order_products[$p['Warehouse']['product_id']]['price'];
            }
            if(isset($in[$p['Warehouse']['product_id']])){
                $array_rebuild[$p['Warehouse']['product_id']]['in_qty'] = $in[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['in_price'] = $in[$p['Warehouse']['product_id']]['price'];
            }
            if(isset($out[$p['Warehouse']['product_id']])){
                $array_rebuild[$p['Warehouse']['product_id']]['out_qty'] = $out[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['out_price'] = $out[$p['Warehouse']['product_id']]['price'];
            }
        }
//        die;
        $products = $array_rebuild;
        $this->set(compact('products','stores','order_products'));
    }

}
