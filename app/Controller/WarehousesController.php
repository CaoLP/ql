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
        if ($this->request->is('post')) {
            if (isset($this->request->data['q'])) {
                $input = $this->request->data['q'];
                $settings['conditions']['OR'] = array(
                    'Product.name like' => '%' . $input . '%',
                    'Warehouse.code like' => '%' . $input . '%'
                );
            }
            if (isset($this->request->data['category_id']) && !empty($this->request->data['category_id'])) {
                $settings['conditions']['Product.category_id'] = $this->request->data['category_id'];
            }
            if (isset($this->request->data['store_id']) && !empty($this->request->data['store_id'])) {
                $settings['conditions']['Warehouse.store_id'] = $this->request->data['store_id'];
            }

            if (isset($this->request->data['qty']) && $this->request->data['qty'] == 0 && $this->request->data['qty'] != '') {
                $settings['conditions']['Warehouse.qty'] = 0;
            } else {
                $settings['conditions']['Warehouse.qty <>'] = 0;
            }

            if (isset($this->request->data['option_id']) && !empty($this->request->data['option_id']) && count($this->request->data['option_id']) > 0) {
                foreach ($this->request->data['option_id'] as $option) {
                    $settings['conditions']['AND'][] = 'FIND_IN_SET(\'' . $option . '\',Warehouse.options)';
                }
            }
            $settings['order'] = array('Warehouse.id' => 'DESC');
            $this->Session->write('Warehouse.paginate', $settings);
            $this->Session->write('Warehouse.request.data', $this->request->data);
            return $this->redirect(array('action' => 'index'));
        }
        if ($this->Session->check('Warehouse.paginate')) {
            $this->paginate = $this->Session->read('Warehouse.paginate');
        } else {
            $settings['conditions']['Warehouse.qty <>'] = 0;
            $settings['order'] = array('Warehouse.id' => 'DESC');
            $this->Paginator->settings = $settings;
        }
        if ($this->Session->check('Warehouse.request.data')) {
            $this->request->data = $this->Session->read('Warehouse.request.data');
        }
        $this->loadModel('Option');
        $options = $this->Option->find('all');
        $stores = $this->Warehouse->Store->find('list');
        $this->loadModel('Category');
        $categories = $this->Category->find('list');
        $optionsData = Set::combine($options, '{n}.Option.id', '{n}.Option.name');
        $options = Set::combine($options, '{n}.Option.id', array('{0} ({1})', '{n}.Option.name', '{n}.Option.code'), '{n}.OptionGroup.name');
        $this->set(compact('options', 'optionsData', 'stores', 'categories'));
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
        $settings = array('limit' => 8);
        $this->loadModel('Option');
        $options = $this->Option->find('list');
        if ($this->request->is('post')) {
            $settings['conditions']['Warehouse.store_id'] = $store_id;
            if (isset($this->request->data['q'])) {
                $input = $this->request->data['q'];
                $settings['conditions']['OR'] = array(
                    'Product.name like' => '%' . $input . '%',
                    'Warehouse.code like' => '%' . $input . '%'
                );
            }
            if (isset($this->request->data['category_id']) && !empty($this->request->data['category_id'])) {
                $settings['conditions']['Product.category_id'] = $this->request->data['category_id'];
            }
            $this->Session->write('Warehouse.ajax_paginate', $settings);
        }
        if ($this->Session->check('Warehouse.paginate')) {
            $settings = $this->Session->read('Warehouse.ajax_paginate');
        }
        $this->paginate = $settings;
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
            $opts = explode(',', $item['Warehouse']['options']);
            $optsName = array();
            foreach ($opts as $op) {
                if (isset($options[$op]))
                    $optsName[] = $options[$op];
            }
            $sub['optionsName'] = implode(',', $optsName);
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
        $input = '';
        if (isset($this->request->query['term'])) $input = $this->request->query['term'];
        $result = $this->Warehouse->filterData($input, $store_id);
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
            $opts = explode(',', $item['Warehouse']['options']);
            $optsName = array();
            foreach ($opts as $op) {
                if (isset($options[$op]))
                    $optsName[] = $options[$op];
            }
            $sub['optionsName'] = implode(',', $optsName);
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
                $name = $this->request->data['P']['name'];
                $sku = $this->request->data['P']['sku'];
                $oldPrice = $this->request->data['P']['price'];
                $oldRetailPrice = $this->request->data['P']['retail_price'];
                $oldQty = $this->request->data['P']['qty'];

                $store = $this->request->data['P']['store'];

                $newQty = $this->request->data['Warehouse']['qty'];
                $newPrice = $this->request->data['Warehouse']['price'];
                $newRetailPrice = $this->request->data['Warehouse']['retail_price'];

                $saveLog = true;

                $message = '[<strong>Kho hàng</strong>][' . $store . '] <strong>' . $this->Session->read('Auth.User.name') . '</strong> đã thay đổi ';
                if ($oldPrice != $newPrice && $newQty != $oldQty && $oldRetailPrice != $newRetailPrice) {
                    $message .= 'giá và số lượng của sản phẩm ' . $name . '( ' . $sku . ' ) ' .
                        '(Giá lẻ [' . number_format($oldPrice, 0, '.', ',') . ']->[' . number_format($newPrice, 0, '.', ',') . ']; ' .
                        'Giá sỉ [' . number_format($oldRetailPrice, 0, '.', ',') . ']->[' . number_format($newRetailPrice, 0, '.', ',') . ']; ' .
                        'Số lượng  [' . $oldQty . ']->[' . $newQty . '])';
                } else if ($oldPrice != $newPrice) {
                    $message .= 'giá bán lẻ của sản phẩm ' . $name . '( ' . $sku . ' ) (Giá lẻ [' . number_format($oldPrice, 0, '.', ',') . ']->[' . number_format($newPrice, 0, '.', ',') . '])';
                } else if ($oldRetailPrice != $newRetailPrice) {
                    $message .= 'giá bán sỉ của sản phẩm ' . $name . '( ' . $sku . ' ) (Giá sỉ [' . number_format($oldRetailPrice, 0, '.', ',') . ']->[' . number_format($newRetailPrice, 0, '.', ',') . '])';
                } else if ($oldQty != $newQty) {
                    $message .= 'số lượng của sản phẩm ' . $name . '( ' . $sku . ' ) (Số lượng  [' . $oldQty . ']->[' . $newQty . '])';
                } else {
                    $saveLog = false;
                }

                if ($saveLog) {
                    $this->loadModel('ActionLog');
                    $this->ActionLog->save(array(
                        'ActionLog' => array(
                            'message' => $message
                        )
                    ));
                }
                if ($this->request->isAjax()) {
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


    public function admin_check()
    {
        $stores = $this->Warehouse->Store->find('list');
        $this->loadModel("WarehouseCheck");
        $this->loadModel("WarehouseCheckDetail");
        $this->set(compact('stores'));
        if ($this->request->is('ajax') && isset($this->request->data["check"])) {
            $this->layout = "ajax";
            $this->view = "admin_check_ajax";
            $this->set('store_name', $this->request->data['store_name']);

            if($this->request->data['WarehouseCheck']['code'] != ''){
                $save = array();

                $warehouse = $this->WarehouseCheckDetail->find("first", array(
                    'conditions' => array(
                        'WarehouseCheckDetail.code' => trim($this->request->data['WarehouseCheck']['code']),
                        'WarehouseCheckDetail.store_id' => $this->request->data['WarehouseCheck']['store_id']
                    )
                ));
                if (count($warehouse) > 0) {
                    $save = $warehouse;
                    $save['WarehouseCheckDetail']['real_qty'] = $save['WarehouseCheckDetail']['real_qty'] + 1;
                } else {
                    $warehouse = $this->Warehouse->find("first", array(
                        'conditions' => array(
                            'Warehouse.code' => trim($this->request->data['WarehouseCheck']['code']),
                            'Warehouse.store_id' => $this->request->data['WarehouseCheck']['store_id']
                        )
                    ));
                    if (count($warehouse) > 0) {
                        $save = array('WarehouseCheckDetail' => $warehouse['Warehouse']);
                        $save['WarehouseCheckDetail']['warehouse_id'] = $save['WarehouseCheckDetail']['id'];
                        unset($save['WarehouseCheckDetail']['id']);
                        unset($save['WarehouseCheckDetail']['created']);
                        unset($save['WarehouseCheckDetail']['created_by']);
                        unset($save['WarehouseCheckDetail']['updated']);
                        unset($save['WarehouseCheckDetail']['updated_by']);
                        $save['WarehouseCheckDetail']['real_qty'] = 1;
                    } else {
                        $product = $this->Warehouse->Product->find('first',
                            array(
                                'conditions' => array(
                                    'Product.sku' => trim($this->request->data['WarehouseCheck']['code']),
                                )
                            )
                        );
                        if (count($product) > 0) {
                            $save = array(
                                'WarehouseCheckDetail' => array(
                                    'store_id' => $this->request->data['WarehouseCheck']['store_id'],
                                    'product_id' => $product['Product']['id'],
                                    'warehouse_id' => 0,
                                    'options' => '',
                                    'price' => $product['Product']['price'],
                                    'retail_price' => $product['Product']['retail_price'],
                                    'qty' => 0,
                                    'code' => $product['Product']['sku'],
                                    'real_qty' => 1
                                )
                            );
                        } else {
                            $product_option = $this->Warehouse->Product->ProductOption->find('first',
                                array(
                                    'conditions' => array(
                                        'ProductOption.code' => trim($this->request->data['WarehouseCheck']['code']),
                                    )
                                )
                            );
                            if (count($product_option) > 0) {
                                $save = array(
                                    'WarehouseCheckDetail' => array(
                                        'store_id' => $this->request->data['WarehouseCheck']['store_id'],
                                        'product_id' => $product_option['Product']['id'],
                                        'warehouse_id' => 0,
                                        'options' => '',
                                        'price' => $product_option['Product']['price'],
                                        'retail_price' => $product_option['Product']['retail_price'],
                                        'qty' => 0,
                                        'code' => $product_option['ProductOption']['code'],
                                        'real_qty' => 1
                                    )
                                );
                            } else {
                                die;
                            }
                        }
                    }
                }
                if (isset($save['WarehouseCheckDetail'])) {
                    $check = $this->WarehouseCheck->find('first',
                        array(
                            'conditions' => array(
                                'WarehouseCheck.store_id' => $this->request->data['WarehouseCheck']['store_id'],
                                'WarehouseCheck.date' => strtotime(date('Y-m-d')),
                            )
                        )
                    );
                    if(count($check) > 0){
                        $save['WarehouseCheckDetail']['warehouse_check_id'] = $check['WarehouseCheck']['id'];
                    }else{
                        $check = array(
                            'WarehouseCheck'=> array(
                                'date' => strtotime(date('Y-m-d')),
                                'store_id' => $this->request->data['WarehouseCheck']['store_id'],
                                'note' => '',
                            )
                        );
                        $this->WarehouseCheck->save($check);
                        $save['WarehouseCheckDetail']['warehouse_check_id'] = $this->WarehouseCheck->id;
                    }
                    $this->WarehouseCheckDetail->save($save);

                    $warehouses = $warehouse = $this->WarehouseCheckDetail->find('all', array(
                        'conditions' => array(
                            'WarehouseCheckDetail.warehouse_check_id'=> $save['WarehouseCheckDetail']['warehouse_check_id']
                        )
                    ));
                    $this->set(compact('warehouses'));
                }
            }else{
                $warehouse_check_detail = $this->WarehouseCheck->find('first', array(
                    'conditions' => array(
                        'WarehouseCheck.date'=> strtotime(date('Y-m-d')),
                        'WarehouseCheck.store_id' => $this->request->data['WarehouseCheck']['store_id'],
                    )
                ));
                $warehouses = array();
                if(count($warehouse_check_detail) > 0)
                    $warehouses = $warehouse = $this->WarehouseCheckDetail->find('all', array(
                        'conditions' => array(
                            'WarehouseCheckDetail.warehouse_check_id'=>$warehouse_check_detail['WarehouseCheck']['id']
                        )
                    ));
                $this->set(compact('warehouses','warehouse_check_detail'));
            }
        } else {
            if ($this->request->is('post')) {

            }else{
                $warehouses = $this->WarehouseCheck->find('first', array(
                    'conditions' => array(
                        'WarehouseCheck.date'=> strtotime(date('Y-m-d')),
                        'WarehouseCheck.store_id' => 1,
                    )
                ));
                $warehouse_check_detail = array();
                if(count($warehouses) > 0)
                $warehouse_check_detail = $warehouse = $this->WarehouseCheckDetail->find('all', array(
                    'conditions' => array(
                        'WarehouseCheckDetail.warehouse_check_id'=>$warehouses['WarehouseCheck']['id']
                    )
                ));
                $this->set(compact('warehouses','warehouse_check_detail'));
            }
        }
    }
    public function admin_warehouse_check_delete($id){
        $this->layout = 'ajax';
        $this->view = 'admin_check_ajax';
        $this->loadModel("WarehouseCheck");
        $this->loadModel("WarehouseCheckDetail");
        $this->WarehouseCheckDetail->delete($id);

        $warehouse_check_detail = $this->WarehouseCheck->find('first', array(
            'conditions' => array(
                'WarehouseCheck.date'=> strtotime(date('Y-m-d')),
                'WarehouseCheck.store_id' => $this->request->data['store_id'],
            )
        ));
        $warehouses = array();
        if(count($warehouse_check_detail) > 0)
            $warehouses = $warehouse = $this->WarehouseCheckDetail->find('all', array(
                'conditions' => array(
                    'WarehouseCheckDetail.warehouse_check_id'=>$warehouse_check_detail['WarehouseCheck']['id']
                )
            ));
        $this->set(compact('warehouses','warehouse_check_detail'));
    }
}
