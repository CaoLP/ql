<?php
App::uses ('AppController', 'Controller');
/**
 * InoutWarehouses Controller
 *
 * @property InoutWarehouse     $InoutWarehouse
 * @property PaginatorComponent $Paginator
 */
class InoutWarehousesController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array ('Paginator');

	public $title_for_layout = 'Quản lý nhập xuất';

	public function  beforeRender () {
		$wtypes = array (
			'Xuất hàng',
			'Nhập hàng',
		);
		$this->set (compact ('wtypes'));
		$status = array (
			'Đang chuyển',
			'Đã chuyển',
		);
		$this->set (compact ('status'));
		parent::beforeRender ();
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_index ($action = '') {
		$this->InoutWarehouse->recursive = 1;
		$this->set ('inoutWarehouses', $this->Paginator->paginate ());
		$stores = $this->InoutWarehouse->Store->find('list');
		$this->set(compact('stores'));
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_in () {
		$this->title_for_layout = 'Phiếu nhập hàng chờ duyệt';
		$this->Paginator->settings = array (
			'conditions' => array (
				'InoutWarehouse.store_receive' => $this->Session->read ('Auth.User.Store.id'),
				'InoutWarehouse.parent_id' => '',
			)
		);

		$this->InoutWarehouse->recursive = 0;
		$this->set ('inoutWarehouses', $this->Paginator->paginate ());
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
	public function admin_view ($id = null, $action = 'view') {
		$showBtn = false;
		if ($action == 'in') $showBtn = true;

		if (!$this->InoutWarehouse->exists ($id)) {
			throw new NotFoundException(__ ('Invalid inout warehouse'));
		}
		$options = array ('conditions' => array ('InoutWarehouse.' . $this->InoutWarehouse->primaryKey => $id));
		$this->set ('inoutWarehouse', $this->InoutWarehouse->find ('first', $options));
		$this->set (compact ('showBtn'));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add () {
		if ($this->request->is ('post')) {
			//			debug($this->request->data);die;
			$this->InoutWarehouse->create ();
			$this->request->data['InoutWarehouse']['code'] = 'DN' . date ("Ymdhis");
			if ($this->InoutWarehouse->save ($this->request->data) && isset($this->request->data['InoutWarehouseDetail'])) {

				$arrStore = array ();
				foreach ($this->request->data['InoutWarehouseDetail'] as $item) {
					$temp = $item;
					$temp['inout_warehouse_id'] = $this->InoutWarehouse->id;
					$arrStore['InoutWarehouseDetail'][] = $temp;
				};
				$this->InoutWarehouse->InoutWarehouseDetail->saveMany ($arrStore['InoutWarehouseDetail']);
				$this->Session->setFlash (__ ('The inout warehouse has been saved.'));

				return $this->redirect (array ('action' => 'index'));
			} else {
				$this->Session->setFlash (__ ('The inout warehouse could not be saved. Please, try again.'));
			}
		}
		$stores = $this->InoutWarehouse->Store->find ('list');
		$customers = $this->InoutWarehouse->Customer->find ('list');
		$this->set (compact ('stores', 'customers'));
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
	public function admin_edit ($id = null) {
        debug($this->request);die;
		if (!$this->InoutWarehouse->exists ($id)) {
			throw new NotFoundException(__ ('Invalid inout warehouse'));
		}
		if ($this->request->is (array ('post', 'put'))) {
			if ($this->InoutWarehouse->save ($this->request->data)) {
				$this->Session->setFlash (__ ('The inout warehouse has been saved.'));

				return $this->redirect (array ('action' => 'index'));
			} else {
				$this->Session->setFlash (__ ('The inout warehouse could not be saved. Please, try again.'));
			}
		} else {
			$options = array ('conditions' => array ('InoutWarehouse.' . $this->InoutWarehouse->primaryKey => $id));
			$this->request->data = $this->InoutWarehouse->find ('first', $options);
		}
		$stores = $this->InoutWarehouse->Store->find ('list');
		$customers = $this->InoutWarehouse->Customer->find ('list');
		$this->set (compact ('stores', 'customers'));
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
	public function admin_approve ($id = null) {
			if ($this->InoutWarehouse->exists ($id)) {
				$data = $this->InoutWarehouse->find ('first',array(
																  'conditions'=>array(
																	  'InoutWarehouse.id'=>$id
																  )
															 ));
				$approvedata = $data['InoutWarehouse'];
				$approvedata['approved'] = date ("Y-m-d h:i:s");
				$approvedata['approved_by'] = $this->Session->read ('Auth.User.id');
				$inoutWarehouse = $data['InoutWarehouse'];
				unset($inoutWarehouse['id']);
				$inoutWarehouse['parent_id'] = $data['InoutWarehouse']['id'];
				$inoutWarehouse['type'] = 1;
				$inoutWarehouseDetail_tmp = $data['InoutWarehouseDetail'];
				$inoutWarehouseDetail=array();
				foreach($inoutWarehouseDetail_tmp as $key=>$val){
					unset($val['id']);
					$inoutWarehouseDetail[] = $val;
				}

				if ($this->InoutWarehouse->save ($inoutWarehouse)) {
//				if (true) {
					$arrStore = array ();
					foreach ($inoutWarehouseDetail as $item) {
						$temp = $item;
						$temp['inout_warehouse_id'] = $this->InoutWarehouse->id;
						$arrStore['InoutWarehouseDetail'][] = $temp;
					};
					$this->InoutWarehouse->InoutWarehouseDetail->saveMany($arrStore['InoutWarehouseDetail']);
					$this->loadModel('Warehouse');
					$warehouse = array();
					$storeId = $this->Session->read ('Auth.User.store_id');

					foreach($arrStore['InoutWarehouseDetail'] as $item){
						$oldData = $this->Warehouse->find('first', array(
															 'conditions'=> array(
																 'Warehouse.store_id'=>$storeId,
																 'Warehouse.product_id'=>$item['product_id'],
																 'Warehouse.options'=>$item['options']
															 ),
															 'recursive' =>-1
														));

						$t = array(
							'store_id'=>$storeId,
							'product_id'=>$item['product_id'],
							'options'=>$item['options'],
							'price'=>$item['price'],
						);
						if(isset($oldData['Warehouse'])){
							$t['id'] = $oldData['Warehouse']['id'];
							$t['qty'] = $item['qty'] + $oldData['Warehouse']['qty'];
						}else{
							$t['qty'] = $item['qty'];
						}
						$warehouse[] = $t;
//						debug($oldData);

					}
					$this->Warehouse->saveMany($warehouse);
//					die;
					$this->InoutWarehouse->save($approvedata);


					$this->Session->setFlash (__ ('The inout warehouse has been saved.'));

					return $this->redirect (array ('action' => 'index', 'in'));
				} else {
					$this->Session->setFlash (__ ('The inout warehouse could not be saved. Please, try again.'));

					return $this->redirect (array ('action' => 'view', $id, 'in'));
				}
		}
		die;
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
	public function admin_delete ($id = null) {
		$this->InoutWarehouse->id = $id;
		if (!$this->InoutWarehouse->exists ()) {
			throw new NotFoundException(__ ('Invalid inout warehouse'));
		}
		$this->request->allowMethod ('post', 'delete');
		if ($this->InoutWarehouse->delete ()) {
			$this->Session->setFlash (__ ('The inout warehouse has been deleted.'));
		} else {
			$this->Session->setFlash (__ ('The inout warehouse could not be deleted. Please, try again.'));
		}

		return $this->redirect (array ('action' => 'index'));
	}
}
