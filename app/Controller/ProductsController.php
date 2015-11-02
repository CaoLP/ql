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
//        $test = $this->Product->find('all');
//        foreach($test as $t){
//            $temp = $t;
//            $temp['Product']['slug'] = $this->make_slug($temp['Product']['name']) . '-' . $temp['Product']['id'];
//            $this->Product->save($temp['Product']);
//        }
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
            $con['order'] = 'Product.created DESC';
            $this->Paginator->settings = $con;
            $this->Product->recursive = 0;
            $this->set('products', $this->Paginator->paginate());
            $this->set(compact('options','providers','categories'));
//            $ps = $this->Product->find('all', array(
//                    'conditions' => array(
//                        'Product.slug' => null
//                    ),
//                    'recursive' => -1
//                )
//            );
//            foreach($ps as $ki=>$pro){
//                $ps[$ki]['Product']['slug'] = $this->make_slug($pro['Product']['name']) . '-' . $pro['Product']['id'];
//            }
//            $this->Product->saveMany($ps);

		}
	}
    public function admin_ajax_index()
    {
        $this->Product->belongsTo = array(
            'Thumb' => array(
                'className' => 'Media',
                'foreignKey' => 'media_id',
                'conditions' => null,
                'counterCache' => false
            )
        );
        $this->Product->hasMany = array();
        if(isset($this->request->query['q'])){
            $settings = array(
                'conditions'=>array(
                    'Product.name <>' => '0',
                    'Product.sku' => $this->request->query['q']
                ),
            );
            $products=$this->Product->find('all',$settings);
            $res = array();
            foreach($products as $p){
                $res[] = array(
                    'value' => $p['Product']['id'],
                    'label' => $p['Product']['sku'] ,
                    'name' => $p['Product']['name'] ,
                    'image' => $p['Thumb']['file'] ,
                    'sku' =>$p['Product']['sku']
                );
            }
            echo json_encode($res);
        }
        die;
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
//        if(isset($this->request->query['media_id'])){
//            $temp = array(
//                'Product' => array(
//                    'sku' => '00000',
//                    'provider_id' => '0',
//                    'name' => 'lÆ°u nhÃ¡p',
//                    'price' => '0',
//                    'excert' => '',
//                    'descriptions' => '',
//                    'status' => '0',
//                    'category_id' => '0',
//                    'media_id' => $this->request->query['media_id'],
//                )
//            );
//            $data = $this->Product->find('first',array('conditions'=>array('Product.sku'=>'00000')));
//            if($data){
//                $id = $data['Product']['id'];
//            }else{
//                $this->Product->save($temp);
//                $id = $this->Product->id;
//                $this->loadModel('Media');
//                $this->Media->save(array(
//                        'Media' => array(
//                            'id' =>  $this->request->query['media_id'],
//                            'ref_id' => $id
//                        )
//                    )
//                );
//            }
//            return $this->redirect(Router::url(array('action'=>'edit',$id,'?'=>array('media_id'=>$this->request->query['media_id']))));
//        }

        if ($this->request->is(array('post', 'put'))) {
            if(isset($this->request->data['Product']['sku']) || !empty($this->request->data['Product']['sku'])){
                if($this->Product->checkCode($this->request->data['Product']['sku']) == 0) {
//                    if(isset($this->request->data['ProductOption']['option_id']) || count($this->request->data['ProductOption']['option_id']) > 0){
                        $this->Product->create();

                        if(empty($this->request->data['Product']['retail_price'])) $this->request->data['Product']['retail_price'] = 0;
                        if(empty($this->request->data['Product']['source_price'])) $this->request->data['Product']['source_price'] = 0;

                        if ($this->Product->save($this->request->data)) {
                            if(isset($this->request->data['ProductOption']['option_id']) && $this->request->data['ProductOption']['option_id'] && count($this->request->data['ProductOption']['option_id']) >0){
                                $product_id = $this->Product->id;
                                $option_data = $this->request->data['ProductOption']['option_id'];
                                $options = array();
                                foreach($option_data as $op){
                                    $code = $this->request->data['Product']['sku'] ;
                                    $options['ProductOption'][] = array('product_id'=>$product_id,'option_id'=>$op, 'code'=>$code);
                                }
                                $this->Product->ProductOption->saveMany($options['ProductOption']);
                            }
                            $this->Session->setFlash(__('The product has been saved.'), 'message', array('class' => 'alert-success'));
                            return $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash(__('KhÃ´ng thá»ƒ lÆ°u'), 'message', array('class' => 'alert-danger'));
                        }
//                    }else {
//                        $this->Session->setFlash(__('Vui lÃ²ng chá»�n thuá»™c tÃ­nh'), 'message', array('class' => 'alert-danger'));
//                    }
                }else {
                    $this->Session->setFlash(__('MÃ£ hÃ ng nÃ y Ä‘Ã£ tá»“n táº¡i'), 'message', array('class' => 'alert-danger'));
                }
            }else {
                $this->Session->setFlash(__('Vui lÃ²ng nháº­p mÃ£ hÃ ng'), 'message', array('class' => 'alert-danger'));
            }
		}
        $id = $this->Product->getNextAutoNumber($this->Product);
        $this->request->data('Product.id',$id);

        if(isset($this->request->query['media_id'])){
            $this->request->data('Product.media_id',$this->request->query['media_id']);
            $this->loadModel('Media');
            $this->Media->save(array(
                    'Media' => array(
                        'id' =>  $this->request->query['media_id'],
                        'ref_id' => $id
                    )
                )
            );
        }
        $providersData = $this->Product->Provider->find('all',array('recursive'=>-1));
        $categories = $this->Product->Category->find('all',array('recursive'=>-1));
        $providersDataCode =Set::combine($providersData,'{n}.Provider.id','{n}.Provider.code');
        $categoriesDataCode =Set::combine($categories,'{n}.Category.id','{n}.Category.code');

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
            if(!isset($this->request->data['Product']['slug']) || empty($this->request->data['Product']['slug']))
                $this->request->data['Product']['slug'] = $this->make_slug($this->request->data['Product']['name']) .'-'.$this->request->data['Product']['id'];
			if ($this->Product->save($this->request->data)) {
				$product_id = $this->request->data['Product']['id'];
                if(isset($this->request->data['ProductOption']['option_id']) && $this->request->data['ProductOption']['option_id'] && count($this->request->data['ProductOption']['option_id']) >0){
				$option_data = $this->request->data['ProductOption']['option_id'];
				$this->Product->ProductOption->deleteAll(array('product_id' => $product_id), false);
				$options = array();
				foreach($option_data as $op){
                    $code = $this->request->data['Product']['sku'];
                    $options['ProductOption'][] = array('product_id'=>$product_id,'option_id'=>$op, 'code'=>$code);
				}
				$this->Product->ProductOption->saveMany($options['ProductOption']);
                }
				$this->Session->setFlash(__('The product has been saved.'));
                if(isset($this->request->query['media_id'])){
                    return $this->redirect(array('admin'=>true,'controller'=>'medias','action' => 'fast_import', 'Product'));
                }
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $d = $this->Product->find('first', $options);
            if($d['Product']['sku'] == '00000'){
                $d['Product']['provider_id'] = '';
                $d['Product']['name'] = '';
                $d['Product']['price'] = '';
                $d['Product']['category_id'] = '';
            }
			$this->request->data =$d;
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
