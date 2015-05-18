<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    public $components = array('RequestHandler');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('warehouse_api','shop_api');
    }
	public function warehouse_api() {
        $this->layout = 'ajax';
        $this->loadModel("Warehouse");
        $settings =  array(
            'fields'=>
                'Warehouse.id,
                Warehouse.code,
                Warehouse.price,
                Warehouse.retail_price,
                Warehouse.qty,
                Store.name as store_name,
                Product.name as product_name',
            'order' => array(
                'Warehouse.created'=>'desc'
            )
        );
        if(isset($this->request->data['store_id']))
            $settings['conditions']['Warehouse.store_id'] =  $this->request->data['store_id'];
        $warehouses = $this->Warehouse->find('all', $settings);
        $result = array();
        foreach($warehouses as $war){
            $result[] = array_merge($war['Warehouse'],$war['Store'],$war['Product']);
        }
        $this->set(array(
            'warehouses' => $result,
            '_serialize' => array('warehouses')
        ));
    }
    public function shop_api() {
        $this->layout = 'ajax';
        $this->loadModel("Store");
        $stores = $this->Store->find('all',array('fields'=>'Store.id,Store.name','recursive'=>-1));
        $result = array();
        foreach($stores as $store){
            $result[] = $store['Store'];
        }
        $this->set(array(
            'stores' => $result,
            '_serialize' => array('stores')
        ));
    }
}
