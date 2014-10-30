<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

	public $title_for_layout = 'Sản phẩm';

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
	public function admin_index() {
		if($this->request->isAjax()){
			$input='';
			if(isset($this->request->query['term'])) $input = $this->request->query['term'];
			$products = $this->Product->filterData($input);
			$this->set(compact('products'));
			$this->layout = 'ajax';
			$this->view = 'admin_ajax_pro';
		}else{
            $this->Product->recursive = 0;
            $this->set('products', $this->Paginator->paginate());
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$product = $this->Product->find('first', $options);
		$this->set('product',$product );
		if($this->request->isAjax()){
			$options = $this->Product->ProductOption->Option->find('all');

			$options = Set::combine($options,'{n}.Option.id','{n}.Option.name','{n}.OptionGroup.name');
			$selected= Set::classicExtract($product,'ProductOption.{n}.option_id');
			$temp = array();
			foreach($options as $name=>$group){
				$temp[$name] = array();
				foreach($group as $key=>$val){
					if(in_array($key,$selected)){
						$temp[$name][$key]=$val;
					}
				}
			}
			$options = $temp;
			$this->set(compact('options'));
			$this->request->data = $product;
			$this->layout = 'ajax';
			$this->view = 'admin_ajax_view';
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$product_id = $this->Product->id;
				$option_data = $this->request->data['ProductOption']['option_id'];
				$options = array();
				foreach($option_data as $op){
					$options['ProductOption'][] = array('product_id'=>$product_id,'option_id'=>$op);
				}
				$this->Product->ProductOption->saveMany($options['ProductOption']);
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$selected= Set::classicExtract($this->request->data,'ProductOption.{n}.option_id');
		$this->set(compact( 'selected'));
		$categories = $this->Product->Category->find('list');
		$options = $this->Product->ProductOption->Option->find('all');
		$options = Set::combine($options,'{n}.Option.id','{n}.Option.name','{n}.OptionGroup.name');
		$this->set(compact( 'categories','options'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
		
			if ($this->Product->save($this->request->data)) {
				$product_id = $this->request->data['Product']['id'];
				$option_data = $this->request->data['ProductOption']['option_id'];
				$this->Product->ProductOption->deleteAll(array('product_id' => $product_id), false);
				$options = array();
				foreach($option_data as $op){
					$options['ProductOption'][] = array('product_id'=>$product_id,'option_id'=>$op);
				}
				$this->Product->ProductOption->saveMany($options['ProductOption']);
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
			$selected= Set::classicExtract($this->request->data,'ProductOption.{n}.option_id');
			$this->set(compact( 'selected'));
		}
		$categories = $this->Product->Category->find('list');
		$options = $this->Product->ProductOption->Option->find('all');
		$options = Set::combine($options,'{n}.Option.id','{n}.Option.name','{n}.OptionGroup.name');
		$this->set(compact( 'categories','options'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
