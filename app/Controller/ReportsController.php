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
        $this->set('title_for_layout', 'Bán hàng và thu tiền theo ngày');
        $options = array();
        if (isset($this->request->data['from']) && isset($this->request->data['to'])) {
            $options['conditions']['Order.created >='] = $this->request->data['from'] . ' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'] . ' 23:59:59';
        } else if (isset($this->request->data['from'])) {
            $options['conditions']['Order.created >='] = $this->request->data['from'] . ' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['from'] . ' 23:59:59';
        } else if (isset($this->request->data['to'])) {
            $options['conditions']['Order.created >='] = $this->request->data['to'] . ' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'] . ' 23:59:59';
        } else {
            $this->request->data['from'] = date('Y-m-d');
            $this->request->data['to'] = date('Y-m-d');
            $options['conditions']['Order.created >='] = $this->request->data['from'] . ' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'] . ' 23:59:59';
        }
        if (isset($this->request->data['filter'])) {
            $filter = $this->request->data['filter'];
        } else {
            $filter = 'qty';
        }
        if (isset($this->request->data['side'])) {
            $side = $this->request->data['side'];
        } else {
            $side = 'desc';
        }
        if (isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])) {
            $options['conditions']['Order.store_id'] = $this->request->data['store_id'];
        }

        $options['conditions']['Order.type'] = 0;

        $this->loadModel('Order');
        $this->loadModel('Store');
        $orders = $this->Order->getReportOrder($options);
        $orders = Set::combine($orders, '{n}.Order.id', '{n}.Order', '{n}.Order.store_id');
        $stores = $this->Store->find('list');
        $this->loadModel('Customer');
        $customers = $this->Customer->find('all', array(
            'fields' => 'id,name,phone',
            'recursive' => -1
        ));
        $customers = Set::combine($customers, '{n}.Customer.id', '{n}.Customer');
        $this->set(compact('orders', 'stores', 'customers'));
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
        $this->set('title_for_layout', 'Báo cáo chi tiết hàng hóa bán ra');
        $options = array();
        if (isset($this->request->data['from']) && isset($this->request->data['to'])) {
            $options['conditions']['Order.created >='] = $this->request->data['from'] . ' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'] . ' 23:59:59';
        } else if (isset($this->request->data['from'])) {
            $options['conditions']['Order.created >='] = $this->request->data['from'] . ' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['from'] . ' 23:59:59';
        } else if (isset($this->request->data['to'])) {
            $options['conditions']['Order.created >='] = $this->request->data['to'] . ' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'] . ' 23:59:59';
        } else {
            $this->request->data['from'] = date('Y-m-d');
            $this->request->data['to'] = date('Y-m-d');
            $options['conditions']['Order.created >='] = $this->request->data['from'] . ' 00:00:00';
            $options['conditions']['Order.created <='] = $this->request->data['to'] . ' 23:59:59';
        }
        if (isset($this->request->data['filter'])) {
            $filter = $this->request->data['filter'];
        } else {
            $filter = 'qty';
        }
        if (isset($this->request->data['side'])) {
            $side = $this->request->data['side'];
        } else {
            $side = 'desc';
        }
        if (isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])) {
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
        foreach ($orders as $key_t => $order) {
            $products = array();
            foreach ($order as $orderDetails) {
                foreach ($orderDetails as $item) {
                    if (isset($products[$item['product_id']])) {
                        $old = $products[$item['product_id']];
                        $products[$item['product_id']]['qty'] = $old['qty'] + $item['qty'];
                    } else {
                        $products[$item['product_id']] = array(
                            'product_id' => $item['product_id'],
                            'sku' => $item['sku'],
                            'name' => $item['name'],
                            'price' => $item['price'],
                            'qty' => $item['qty'],
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
        $conditions = array();
        $store_id = 1;
        $summary = array(
            'before_total' => 0,
            'before_price' => 0,
            'ship' => 0,
            'in_qty' => 0,
            'in_price' => 0,
            'out_qty' => 0,
            'out_price' => 0,
            'sale_qty' => 0,
            'sale_promote' => 0,
            'sale_price' => 0,
            'after_total' => 0,
            'after_price' => 0,
            'profit' => 0,
        );
        $date = array(date('Y-m-01 00:00'), date('Y-m-t 23:59'));
        if (isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])) {
            $store_id = $this->request->data['store_id'];
            $conditions['Warehouse.store_id'] = $store_id;
        }
        if (!empty($this->request->data['from']) && !empty($this->request->data['to'])) {
            $date = array(
                $this->request->data['from'] . ' 00:00:00',
                $this->request->data['to'] . ' 23:59:59'
            );
        } else if (!empty($this->request->data['from'])) {
            $date = array(
                $this->request->data['from'] . ' 00:00:00',
                $this->request->data['from'] . ' 23:59:59'
            );
        } else if (!empty($this->request->data['to'])) {
            $date = array(
                $this->request->data['to'] . ' 00:00:00',
                $this->request->data['to'] . ' 23:59:59'
            );
        }
        $this->loadModel('Warehouse');
        $products = $this->Warehouse->find('all', array(
            'fields' => array(
                'Warehouse.product_id',
                'Sum(Warehouse.qty) as total',
                'Product.name',
                'Product.sku',
                'Product.price',
                'Product.category_id',
                'Product.retail_price',
                'Product.source_price',
            ),
            'recursive' => 1,
            'conditions' => $conditions,
            'group' => array('Warehouse.product_id'),
            'order' => array('total' => 'desc'),
        ));
        $this->loadModel('WarehouseLog');
        $warehouse_logs = $this->WarehouseLog->find('all', array(
            'fields' => array('WarehouseLog.product_id','WarehouseLog.qty','WarehouseLog.new_qty','MaxDate.max_created'),
            'joins' => array(
                array(
                    'table' => "(SELECT warehouse_id , MAX(created) as max_created
						from warehouse_logs
						where created < '" . $date[0] . "' AND store_id = " . $store_id . "
						group by warehouse_id)",
                    'type' => 'INNER',
                    'alias' => 'MaxDate',
                    'conditions' => array(
                        'MaxDate.max_created = WarehouseLog.created',
                        'MaxDate.warehouse_id = WarehouseLog.warehouse_id',
                    )
                )
            )
        ));
        $warehouse_logs = Set::combine($warehouse_logs, '{n}.WarehouseLog.product_id', '{n}');

        $warehouse_logs_2 = $this->WarehouseLog->find('all', array(
            'fields' => array('WarehouseLog.product_id','WarehouseLog.qty','WarehouseLog.new_qty','MinDate.min_created'),
            'joins' => array(
                array(
                    'table' => "(SELECT warehouse_id , MIN(created) as min_created
						from warehouse_logs
						where created > '" . $date[1] . "' AND store_id = " . $store_id . "
						group by warehouse_id)",
                    'type' => 'INNER',
                    'alias' => 'MinDate',
                    'conditions' => array(
                        'MinDate.min_created = WarehouseLog.created',
                        'MinDate.warehouse_id = WarehouseLog.warehouse_id',
                    )
                )
            )
        ));
        $warehouse_logs_2 = Set::combine($warehouse_logs_2, '{n}.WarehouseLog.product_id', '{n}');


        $array_rebuild = array();
        $this->loadModel('Store');
        $stores = $this->Store->find('list');
        $this->loadModel('OrderDetail');
        $order_products = $this->OrderDetail->find('all', array(
            'fields' => array(
                'OrderDetail.product_id',
                'Sum(OrderDetail.qty) as qty',
                'Sum(OrderDetail.qty * OrderDetail.price) as price',
                'Sum(OrderDetail.qty * OrderDetail.promote_value) as promote',
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
        $order_products = Set::combine($order_products, '{n}.OrderDetail.product_id', '{n}.0');
        $orders = $this->OrderDetail->Order->find('all', array(
            'fields' => array(
                'Sum(Order.total_promote) as promote',
            ),
            'conditions' => array(
                'Order.created between ? and ?' => $date,
                'Order.status' => 1,
                'Order.store_id' => $store_id,
            )
        ));
        if (isset($orders[0][0]['promote']))
            $summary['sale_promote'] = $orders[0][0]['promote'];
//        debug($orders);die;

        $this->loadModel('InoutWarehouseDetail');
        $in = $this->InoutWarehouseDetail->find('all', array(
            'fields' => array(
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
        $in = Set::combine($in, '{n}.InoutWarehouseDetail.product_id', '{n}.0');
        $out = $this->InoutWarehouseDetail->find('all', array(
            'fields' => array(
                'InoutWarehouseDetail.product_id',
                'Sum(InoutWarehouseDetail.qty_received) as qty',
                'Sum(InoutWarehouseDetail.qty_received * InoutWarehouseDetail.price) as price',
            ),
            'conditions' => array(
                'InoutWarehouse.created between ? and ?' => $date,
                'InoutWarehouse.status' => 1,
                'InoutWarehouse.type' => 1,
                'InoutWarehouse.store_id' => $store_id,
            ),
            'group' => array(
                'InoutWarehouseDetail.product_id'
            )
        ));
        $out = Set::combine($out, '{n}.InoutWarehouseDetail.product_id', '{n}.0');
        foreach ($products as $k => $p) {
            $array_rebuild[$p['Warehouse']['product_id']] = array(
                'code' => $p['Product']['sku'],
                'name' => $p['Product']['name'],
                'price' => $p['Product']['price'],
                'retail_price' => $p['Product']['retail_price'],
                'source_price' => $p['Product']['source_price'],
                'before_total' => 0,
                'in_qty' => 0,
                'in_price' => 0,
                'out_qty' => 0,
                'out_price' => 0,
                'sale_qty' => 0,
                'sale_promote' => 0,
                'sale_price' => 0,
                'after_total' => $p[0]['total'],
                'profit' => 0,
                'category_id' => $p['Product']['category_id'],
                'product_id' => $p['Warehouse']['product_id'],
            );
//            if($p['Warehouse']['product_id'] == 161) {
//                debug($order_products[$p['Warehouse']['product_id']]['qty']);
//                debug($in[$p['Warehouse']['product_id']]['qty']);
//                debug($out[$p['Warehouse']['product_id']]['qty']);
//                debug($warehouse_logs[$p['Warehouse']['product_id']]['qty']);
////                debug($array_rebuild);
//                die;
//            }
            if (isset($order_products[$p['Warehouse']['product_id']])) {
                $array_rebuild[$p['Warehouse']['product_id']]['sale_qty'] = $order_products[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['sale_promote'] = $order_products[$p['Warehouse']['product_id']]['promote'];
                $array_rebuild[$p['Warehouse']['product_id']]['sale_price'] = $order_products[$p['Warehouse']['product_id']]['price'];
                $summary['sale_qty'] += $order_products[$p['Warehouse']['product_id']]['qty'];
                $summary['sale_price'] += $order_products[$p['Warehouse']['product_id']]['price'];
            }
            if (isset($in[$p['Warehouse']['product_id']])) {
                $array_rebuild[$p['Warehouse']['product_id']]['in_qty'] = $in[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['in_price'] = $in[$p['Warehouse']['product_id']]['price'];
                $summary['in_qty'] += $in[$p['Warehouse']['product_id']]['qty'];
                $summary['in_price'] += $in[$p['Warehouse']['product_id']]['price'];
            }
            if (isset($out[$p['Warehouse']['product_id']])) {
                $array_rebuild[$p['Warehouse']['product_id']]['out_qty'] = $out[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['out_price'] = $out[$p['Warehouse']['product_id']]['price'];
                $summary['out_qty'] += $out[$p['Warehouse']['product_id']]['qty'];
                $summary['out_price'] += $out[$p['Warehouse']['product_id']]['price'];
            }
            if(isset($warehouse_logs_2[$p['Warehouse']['product_id']])){
                if( $warehouse_logs_2[$p['Warehouse']['product_id']]['WarehouseLog']['new_qty'] > -1){
                    $array_rebuild[$p['Warehouse']['product_id']]['after_total'] = $warehouse_logs_2[$p['Warehouse']['product_id']]['WarehouseLog']['new_qty'];
                }else{
                    $p_id= $p['Warehouse']['product_id'];
                    $min_date = $warehouse_logs_2[$p['Warehouse']['product_id']]['MinDate']['min_created'];
                    $min_date = date('Y-m-d H:i', strtotime($min_date));
                    $order_products_sub_1 = $this->OrderDetail->find('all', array(
                        'fields' => array(
                            'OrderDetail.product_id',
                            'Sum(OrderDetail.qty) as qty',
                            'Sum(OrderDetail.qty * OrderDetail.price) as price',
                            'Sum(OrderDetail.qty * OrderDetail.promote_value) as promote',
                        ),
                        'conditions' => array(
                            'Order.created like' => '%'.$min_date.'%',
//                            'Order.created like' => '%'.$min_date.'%',
                            'OrderDetail.product_id'=> $p_id,
                            'Order.status' => 1,
                            'Order.store_id' => $store_id,
                        ),
                        'group' => array(
                            'OrderDetail.product_id'
                        )
                    ));
                    $order_products_sub_1 = Set::combine($order_products_sub_1, '{n}.OrderDetail.product_id', '{n}.0');
                    $in_sub_1 = $this->InoutWarehouseDetail->find('all', array(
                        'fields' => array(
                            'InoutWarehouseDetail.product_id',
                            'Sum(InoutWarehouseDetail.qty) as qty',
                            'Sum(InoutWarehouseDetail.qty * InoutWarehouseDetail.price) as price',
                        ),
                        'conditions' => array(
                            'InoutWarehouse.approved like'=> '%'.$min_date.'%',
                            'InoutWarehouseDetail.product_id'=> $p_id,
                            'InoutWarehouse.status' => 1,
                            'InoutWarehouse.type' => 0,
                            'InoutWarehouse.store_id' => $store_id,
                        ),
                        'group' => array(
                            'InoutWarehouseDetail.product_id'
                        )
                    ));
                    $in_sub_1 = Set::combine($in_sub_1, '{n}.InoutWarehouseDetail.product_id', '{n}.0');
                    $out_sub_1 = $this->InoutWarehouseDetail->find('all', array(
                        'fields' => array(
                            'InoutWarehouseDetail.product_id',
                            'Sum(InoutWarehouseDetail.qty_received) as qty',
                            'Sum(InoutWarehouseDetail.qty_received * InoutWarehouseDetail.price) as price',
                        ),
                        'conditions' => array(
                            'InoutWarehouse.created like'=> '%'.$min_date.'%',
                            'InoutWarehouseDetail.product_id'=> $p_id,
                            'InoutWarehouse.status' => 1,
                            'InoutWarehouse.type' => 1,
                            'InoutWarehouse.store_id' => $store_id,
                        ),
                        'group' => array(
                            'InoutWarehouseDetail.product_id'
                        )
                    ));
                    $out_sub_1 = Set::combine($out_sub_1, '{n}.InoutWarehouseDetail.product_id', '{n}.0');


                    $array_rebuild[$p['Warehouse']['product_id']]['after_total'] = 0;
                    if(count($order_products_sub_1) == 0 && count($in_sub_1) == 0 && count($out_sub_1)  == 0){
                        $array_rebuild[$p['Warehouse']['product_id']]['after_total'] =  $warehouse_logs_2[$p_id]['WarehouseLog']['qty'];
                    }else{
                        if(count($order_products_sub_1) > 0){
                            $array_rebuild[$p['Warehouse']['product_id']]['after_total'] = $warehouse_logs_2[$p_id]['WarehouseLog']['qty'] +  $order_products_sub_1[$p_id]['qty'];
                        }
                        if(count($in_sub_1) > 0){
                            $array_rebuild[$p['Warehouse']['product_id']]['after_total'] = $warehouse_logs_2[$p_id]['WarehouseLog']['qty'] - $in_sub_1[$p_id]['qty'];
                        }
                        if(count($out_sub_1) > 0){
                            $array_rebuild[$p['Warehouse']['product_id']]['after_total'] = $warehouse_logs_2[$p_id]['WarehouseLog']['qty'] + $out_sub_1[$p_id]['qty'];
                        }
                    }

                }
//                $array_rebuild[$p['Warehouse']['product_id']]['after_total'] = $warehouse_logs_2[$p['Warehouse']['product_id']]['qty'];
                $summary['after_total'] += $array_rebuild[$p['Warehouse']['product_id']]['after_total'];
                $summary['after_price'] += $array_rebuild[$p['Warehouse']['product_id']]['after_total'] * $p['Product']['price'];
            }else{
                if( $array_rebuild[$p['Warehouse']['product_id']]['after_total'] == 0
                && ($array_rebuild[$p['Warehouse']['product_id']]['in_qty'] > 0)
                )
                $array_rebuild[$p['Warehouse']['product_id']]['after_total'] =
                     $array_rebuild[$p['Warehouse']['product_id']]['in_qty']
                    - $array_rebuild[$p['Warehouse']['product_id']]['out_qty']
                    - $array_rebuild[$p['Warehouse']['product_id']]['sale_qty'];

                $summary['after_total'] += $array_rebuild[$p['Warehouse']['product_id']]['after_total'];
                $summary['after_price'] += $array_rebuild[$p['Warehouse']['product_id']]['after_total'] * $p['Product']['price'] ;
            }

            if(isset($warehouse_logs[$p['Warehouse']['product_id']])){
                if( $warehouse_logs[$p['Warehouse']['product_id']]['WarehouseLog']['new_qty'] > -1){
                    $array_rebuild[$p['Warehouse']['product_id']]['before_total'] = $warehouse_logs[$p['Warehouse']['product_id']]['WarehouseLog']['new_qty'];
                }else{
                    $p_id= $p['Warehouse']['product_id'];
                    $max_date = $warehouse_logs[$p['Warehouse']['product_id']]['MaxDate']['max_created'];
                    $max_date = date('Y-m-d H:i', strtotime($max_date));
                    $order_products_sub_1 = $this->OrderDetail->find('all', array(
                        'fields' => array(
                            'OrderDetail.product_id',
                            'Sum(OrderDetail.qty) as qty',
                            'Sum(OrderDetail.qty * OrderDetail.price) as price',
                            'Sum(OrderDetail.qty * OrderDetail.promote_value) as promote',
                        ),
                        'conditions' => array(
                            'Order.created like' => '%'.$max_date.'%',
//                            'Order.created like' => '%'.$max_date.'%',
                            'OrderDetail.product_id'=> $p_id,
                            'Order.status' => 1,
                            'Order.store_id' => $store_id,
                        ),
                        'group' => array(
                            'OrderDetail.product_id'
                        )
                    ));
                    $order_products_sub_1 = Set::combine($order_products_sub_1, '{n}.OrderDetail.product_id', '{n}.0');
                    $in_sub_1 = $this->InoutWarehouseDetail->find('all', array(
                        'fields' => array(
                            'InoutWarehouseDetail.product_id',
                            'Sum(InoutWarehouseDetail.qty) as qty',
                            'Sum(InoutWarehouseDetail.qty * InoutWarehouseDetail.price) as price',
                        ),
                        'conditions' => array(
                            'InoutWarehouse.approved like'=> '%'.$max_date.'%',
                            'InoutWarehouseDetail.product_id'=> $p_id,
                            'InoutWarehouse.status' => 1,
                            'InoutWarehouse.type' => 0,
                            'InoutWarehouse.store_id' => $store_id,
                        ),
                        'group' => array(
                            'InoutWarehouseDetail.product_id'
                        )
                    ));
                    $in_sub_1 = Set::combine($in_sub_1, '{n}.InoutWarehouseDetail.product_id', '{n}.0');
                    $out_sub_1 = $this->InoutWarehouseDetail->find('all', array(
                        'fields' => array(
                            'InoutWarehouseDetail.product_id',
                            'Sum(InoutWarehouseDetail.qty_received) as qty',
                            'Sum(InoutWarehouseDetail.qty_received * InoutWarehouseDetail.price) as price',
                        ),
                        'conditions' => array(
                            'InoutWarehouse.created like'=> '%'.$max_date.'%',
                            'InoutWarehouseDetail.product_id'=> $p_id,
                            'InoutWarehouse.status' => 1,
                            'InoutWarehouse.type' => 1,
                            'InoutWarehouse.store_id' => $store_id,
                        ),
                        'group' => array(
                            'InoutWarehouseDetail.product_id'
                        )
                    ));
                    $out_sub_1 = Set::combine($out_sub_1, '{n}.InoutWarehouseDetail.product_id', '{n}.0');
//                    if($p_id == 497){
//                        debug(
//                            array(
//                                $order_products_sub_1,
//                                $in_sub_1,
//                                $out_sub_1,
//                            )
//                        );
//                    }
                    $array_rebuild[$p['Warehouse']['product_id']]['before_total'] = 0;
                    if(count($order_products_sub_1) == 0 && count($in_sub_1) == 0 && count($out_sub_1)  == 0){
                        $array_rebuild[$p['Warehouse']['product_id']]['before_total'] =  $warehouse_logs[$p_id]['WarehouseLog']['qty'];
                    }else{
                        if(count($order_products_sub_1) > 0){
                            $array_rebuild[$p['Warehouse']['product_id']]['before_total'] = $warehouse_logs[$p_id]['WarehouseLog']['qty'] - $order_products_sub_1[$p_id]['qty'];
                        }
                        if(count($in_sub_1) > 0){
                            $array_rebuild[$p['Warehouse']['product_id']]['before_total'] = $warehouse_logs[$p_id]['WarehouseLog']['qty'] + $in_sub_1[$p_id]['qty'];
                        }
                        if(count($out_sub_1) > 0){
                            $array_rebuild[$p['Warehouse']['product_id']]['before_total'] = $warehouse_logs[$p_id]['WarehouseLog']['qty'] - $out_sub_1[$p_id]['qty'];
                        }
                    }
                }
                $summary['before_total'] += $array_rebuild[$p['Warehouse']['product_id']]['before_total'];
                $summary['before_price'] += $array_rebuild[$p['Warehouse']['product_id']]['before_total'] * $p['Product']['price'];
            }else{

//                if($p['Warehouse']['product_id'] == 497){
//                    debug(array(
//                        $array_rebuild[$p['Warehouse']['product_id']]
//                    ));
//                }
                $array_rebuild[$p['Warehouse']['product_id']]['before_total'] =
                    $array_rebuild[$p['Warehouse']['product_id']]['after_total']
                    - $array_rebuild[$p['Warehouse']['product_id']]['in_qty']
                    + $array_rebuild[$p['Warehouse']['product_id']]['out_qty']
                    + $array_rebuild[$p['Warehouse']['product_id']]['sale_qty'];
                $summary['before_total'] += $array_rebuild[$p['Warehouse']['product_id']]['before_total'];
                $summary['before_price'] +=  $array_rebuild[$p['Warehouse']['product_id']]['before_total'] * $p['Product']['price'];
            }

        }
//        die;
        $categories = Set::combine($array_rebuild,'{n}.code','{n}','{n}.category_id');
        $this->loadModel('Category');
        $cats = $this->Category->find('list');
        $this->set('title_for_layout', 'Báo cáo Nhập-Xuất-Tồn từ ' . $date[0] . ' đến ' . $date[1]);
        $this->set(compact('categories', 'stores', 'order_products', 'date', 'summary','cats'));
    }

    public function admin_product_underlimited()
    {

    }

    public function admin_debtors()
    {

    }

    public function admin_warehouse()
    {
        $conditions = array();
        $store_id = 1;
        $summary = array(
            'before_total' => 0,
            'before_price' => 0,
            'ship' => 0,
            'in_qty' => 0,
            'in_price' => 0,
            'out_qty' => 0,
            'out_price' => 0,
            'sale_qty' => 0,
            'sale_promote' => 0,
            'sale_price' => 0,
            'after_total' => 0,
            'after_price' => 0,
            'profit' => 0,
        );
        $date = array(date('Y-m-01 00:00'), date('Y-m-t 23:59'));
        if (isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])) {
            $store_id = $this->request->data['store_id'];
            $conditions['Warehouse.store_id'] = $store_id;
        }
        if (!empty($this->request->data['from']) && !empty($this->request->data['to'])) {
            $date = array(
                $this->request->data['from'] . ' 00:00:00',
                $this->request->data['to'] . ' 23:59:59'
            );
        } else if (!empty($this->request->data['from'])) {
            $date = array(
                $this->request->data['from'] . ' 00:00:00',
                $this->request->data['from'] . ' 23:59:59'
            );
        } else if (!empty($this->request->data['to'])) {
            $date = array(
                $this->request->data['to'] . ' 00:00:00',
                $this->request->data['to'] . ' 23:59:59'
            );
        }
        $this->loadModel('Warehouse');
        $products = $this->Warehouse->find('all', array(
            'fields' => array(
                'Warehouse.product_id',
                'Sum(Warehouse.qty) as total',
                'Product.name',
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
        $this->loadModel('WarehouseLog');
        $warehouse_logs = $this->WarehouseLog->find('all', array(
            'fields' => array('WarehouseLog.product_id','WarehouseLog.qty'),
            'joins' => array(
                array(
                    'table' => "(SELECT warehouse_id , MAX(created) as max_created
						from warehouse_logs
						where created < '" . $date[0] . "' AND store_id = " . $store_id . "
						group by warehouse_id)",
                    'type' => 'INNER',
                    'alias' => 'MaxDate',
                    'conditions' => array(
                        'MaxDate.max_created = WarehouseLog.created',
                        'MaxDate.warehouse_id = WarehouseLog.warehouse_id',
                    )
                )
            )
        ));
        $warehouse_logs = Set::combine($warehouse_logs, '{n}.WarehouseLog.product_id', '{n}.WarehouseLog');

        $warehouse_logs_2 = $this->WarehouseLog->find('all', array(
            'fields' => array('WarehouseLog.product_id','WarehouseLog.qty'),
            'joins' => array(
                array(
                    'table' => "(SELECT warehouse_id , MIN(created) as min_created
						from warehouse_logs
						where created > '" . $date[1] . "' AND store_id = " . $store_id . "
						group by warehouse_id)",
                    'type' => 'INNER',
                    'alias' => 'MinDate',
                    'conditions' => array(
                        'MinDate.min_created = WarehouseLog.created',
                        'MinDate.warehouse_id = WarehouseLog.warehouse_id',
                    )
                )
            )
        ));
        $warehouse_logs_2 = Set::combine($warehouse_logs_2, '{n}.WarehouseLog.product_id', '{n}.WarehouseLog');



        $array_rebuild = array();
        $this->loadModel('Store');
        $stores = $this->Store->find('list');
        $this->loadModel('OrderDetail');
        $order_products = $this->OrderDetail->find('all', array(
            'fields' => array(
                'OrderDetail.product_id',
                'Sum(OrderDetail.qty) as qty',
                'Sum(OrderDetail.qty * OrderDetail.price) as price',
                'Sum(OrderDetail.qty * OrderDetail.promote_value) as promote',
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
        $order_products = Set::combine($order_products, '{n}.OrderDetail.product_id', '{n}.0');
        $orders = $this->OrderDetail->Order->find('all', array(
            'fields' => array(
                'Sum(Order.total_promote) as promote',
            ),
            'conditions' => array(
                'Order.created between ? and ?' => $date,
                'Order.status' => 1,
                'Order.store_id' => $store_id,
            )
        ));
        if (isset($orders[0][0]['promote']))
            $summary['sale_promote'] = $orders[0][0]['promote'];
//        debug($orders);die;

        $this->loadModel('InoutWarehouseDetail');
        $in = $this->InoutWarehouseDetail->find('all', array(
            'fields' => array(
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
        $in = Set::combine($in, '{n}.InoutWarehouseDetail.product_id', '{n}.0');
        $out = $this->InoutWarehouseDetail->find('all', array(
            'fields' => array(
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
        $out = Set::combine($out, '{n}.InoutWarehouseDetail.product_id', '{n}.0');
        foreach ($products as $k => $p) {
            $array_rebuild[$p['Warehouse']['product_id']] = array(
                'code' => $p['Product']['sku'],
                'name' => $p['Product']['name'],
                'price' => $p['Product']['price'],
                'retail_price' => $p['Product']['retail_price'],
                'source_price' => $p['Product']['source_price'],
                'before_total' => 0,
                'in_qty' => 0,
                'in_price' => 0,
                'out_qty' => 0,
                'out_price' => 0,
                'sale_qty' => 0,
                'sale_promote' => 0,
                'sale_price' => 0,
                'after_total' => $p[0]['total'],
                'profit' => 0,
            );
            $summary['after_total'] += $p[0]['total'];
            if (isset($order_products[$p['Warehouse']['product_id']])) {
                $array_rebuild[$p['Warehouse']['product_id']]['sale_qty'] = $order_products[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['sale_promote'] = $order_products[$p['Warehouse']['product_id']]['promote'];
                $array_rebuild[$p['Warehouse']['product_id']]['sale_price'] = $order_products[$p['Warehouse']['product_id']]['price'];
                $summary['sale_qty'] += $order_products[$p['Warehouse']['product_id']]['qty'];
                $summary['sale_price'] += $order_products[$p['Warehouse']['product_id']]['price'];
            }
            if (isset($in[$p['Warehouse']['product_id']])) {
                $array_rebuild[$p['Warehouse']['product_id']]['in_qty'] = $in[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['in_price'] = $in[$p['Warehouse']['product_id']]['price'];
                $summary['in_qty'] += $in[$p['Warehouse']['product_id']]['qty'];
                $summary['in_price'] += $in[$p['Warehouse']['product_id']]['price'];
            }
            if (isset($out[$p['Warehouse']['product_id']])) {
                $array_rebuild[$p['Warehouse']['product_id']]['out_qty'] = $out[$p['Warehouse']['product_id']]['qty'];
                $array_rebuild[$p['Warehouse']['product_id']]['out_price'] = $out[$p['Warehouse']['product_id']]['price'];
                $summary['out_qty'] += $out[$p['Warehouse']['product_id']]['qty'];
                $summary['out_price'] += $out[$p['Warehouse']['product_id']]['price'];
            }
            if(isset($warehouse_logs_2[$p['Warehouse']['product_id']])){
                $array_rebuild[$p['Warehouse']['product_id']]['after_total'] = $warehouse_logs_2[$p['Warehouse']['product_id']]['qty'];
                $summary['after_total'] += $warehouse_logs_2[$p['Warehouse']['product_id']]['qty'];
                $summary['after_price'] += $array_rebuild[$p['Warehouse']['product_id']]['after_total'] * $p['Product']['price'];
            }else{

                $summary['after_total'] += $p[0]['total'];
                $summary['after_price'] += $p[0]['total'] * $p['Product']['price'] ;
            }
            if(isset($warehouse_logs[$p['Warehouse']['product_id']])){
                $array_rebuild[$p['Warehouse']['product_id']]['before_total'] = $warehouse_logs[$p['Warehouse']['product_id']]['qty'];
                $summary['before_total'] += $warehouse_logs[$p['Warehouse']['product_id']]['qty'];
            }else{
                $array_rebuild[$p['Warehouse']['product_id']]['before_total'] =
                    $array_rebuild[$p['Warehouse']['product_id']]['after_total']
                    - $array_rebuild[$p['Warehouse']['product_id']]['in_qty']
                    + $array_rebuild[$p['Warehouse']['product_id']]['out_qty']
                    + $array_rebuild[$p['Warehouse']['product_id']]['sale_qty'];
                $summary['before_total'] += $array_rebuild[$p['Warehouse']['product_id']]['before_total'];
            }
        }
//        die;
        $products = $array_rebuild;
        $this->set('title_for_layout', 'Báo cáo thống kê lợi nhuận từ ' . $date[0] . ' đến ' . $date[1]);
        $this->set(compact('products', 'stores', 'order_products', 'date', 'summary'));
    }

}
