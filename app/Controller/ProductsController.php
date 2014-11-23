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
            $options = $this->Product->ProductOption->Option->find('all');
            $providers = $this->Product->Provider->find('list');
            $categories = $this->Product->Category->find('list');
            $options = Set::combine($options,'{n}.Option.id',array('{0} ({1})','{n}.Option.name','{n}.Option.code'),'{n}.OptionGroup.name');

            /*
             array(
                    'q' => 'aaaa',
                    'category_id' => '1',
                    'provider_id' => '14',
                    'option_id' => array(
                                        (int) 0 => '1',
                                        (int) 1 => '2',
                                        (int) 2 => '7',
                                        (int) 3 => '4',
                                        (int) 4 => '5',
                                        (int) 5 => '16'
                    )
                )
             * */
            $con = array();
            if(isset($this->request->data['q'])){
                $input =$this->request->data['q'];
                $con['conditions']['OR'] =  array(
                            'Product.name like' => '%' . $input . '%',
                            'Product.sku like' => '%' . $input . '%'
                            );
            }
            if(isset($this->request->data['category_id']) && !empty($this->request->data['category_id'])){
                $con['conditions']['Product.category_id'] = $this->request->data['category_id'];
            }
            if(isset($this->request->data['provider_id']) && !empty($this->request->data['provider_id'])){
                $con['conditions']['Product.provider_id'] = $this->request->data['provider_id'];
            }
//            if(isset($this->request->data['option_id']) && count($this->request->data['option_id']) > 0){
//                $con['conditions']['ProductOption.option_id'] = $this->request->data['option_id'];
//            }
            $this->Paginator->settings = $con;
            $this->Product->recursive = 0;
            $this->set('products', $this->Paginator->paginate());
            $this->set(compact('options','providers','categories'));
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
        $providersData = $this->Product->Provider->find('all',array('recursive'=>-1));
        $categories = $this->Product->Category->find('all',array('recursive'=>-1));
        $providersDataCode =Set::combine($providersData,'{n}.Provider.id','{n}.Provider.code');
        $categoriesDataCode =Set::combine($categories,'{n}.Category.id','{n}.Category.code');
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$product_id = $this->Product->id;
				$option_data = $this->request->data['ProductOption']['option_id'];
				$options = array();
				foreach($option_data as $op){
                    $code = $this->request->data['Product']['sku']
                        .$providersDataCode[$this->request->data['Product']['provider_id']]
                    ;
					$options['ProductOption'][] = array('product_id'=>$product_id,'option_id'=>$op, 'code'=>$code);
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

		$options = $this->Product->ProductOption->Option->find('all');
        $categories =  Set::combine($categories,'{n}.Category.id','{n}.Category.name');
        $providers = Set::combine($providersData,'{n}.Provider.id','{n}.Provider.name');
		$options = Set::combine($options,'{n}.Option.id',array('{0} ({1})','{n}.Option.name','{n}.Option.code'),'{n}.OptionGroup.name');
        $this->set(compact( 'categories','options','providers','providersData'));
        $optionGroups = $this->Product->ProductOption->Option->OptionGroup->find('list');
        $this->set(compact('optionGroups'));
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
        $providersData = $this->Product->Provider->find('all',array('recursive'=>-1));
        $categories = $this->Product->Category->find('all',array('recursive'=>-1));
        $providersDataCode =Set::combine($providersData,'{n}.Provider.id','{n}.Provider.code');
        $categoriesDataCode =Set::combine($categories,'{n}.Category.id','{n}.Category.code');
        if ($this->request->is(array('post', 'put'))) {
		
			if ($this->Product->save($this->request->data)) {
				$product_id = $this->request->data['Product']['id'];
				$option_data = $this->request->data['ProductOption']['option_id'];
				$this->Product->ProductOption->deleteAll(array('product_id' => $product_id), false);
				$options = array();
				foreach($option_data as $op){
                    $code = $this->request->data['Product']['sku']
                        .$providersDataCode[$this->request->data['Product']['provider_id']]
                    ;
                    $options['ProductOption'][] = array('product_id'=>$product_id,'option_id'=>$op, 'code'=>$code);
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
        $categories =  Set::combine($categories,'{n}.Category.id','{n}.Category.name');
		$options = $this->Product->ProductOption->Option->find('all');

        $providers = Set::combine($providersData,'{n}.Provider.id','{n}.Provider.name');
        $options = Set::combine($options,'{n}.Option.id',array('{0} ({1})','{n}.Option.name','{n}.Option.code'),'{n}.OptionGroup.name');
        $this->set(compact( 'categories','options','providers','providersData'));
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
