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

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function admin_orders()
    {

    }

    public function admin_products()
    {
        $this->loadModel('Order');
        $this->loadModel('Store');
        $orders = $this->Order->getReportOrder('all');
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

                   }else{
                       $products[$item['product_id']] = array(
                           'product_id' =>$item[''] ,
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
        debug($orders);die;
        $stores = $this->Store->find('list');
        $this->set(compact('orders', 'stores'));
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
