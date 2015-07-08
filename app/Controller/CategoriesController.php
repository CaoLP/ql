<?php
App::uses ('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category           $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

	public $title_for_layout = 'Danh mục sản phẩm';
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array ('Paginator');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_index () {
//        $test = $this->Category->find('all');
//        foreach($test as $t){
//            $temp = $t;
//            $temp['Category']['slug'] = $this->make_slug($temp['Category']['name']);
//            $this->Category->save($temp['Category']);
//        }
		$this->Category->recursive = 0;
		if ($this->request->isAjax ()) {
			$this->set ('categories', $this->Category->find('list'));
			$this->layout = 'ajax';
			$this->view = 'admin_ajax_cat';
		} else {
			$this->set ('categories', $this->Paginator->paginate ());
		}
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
	public function admin_view ($id = null) {
		if (!$this->Category->exists ($id)) {
			throw new NotFoundException(__ ('Invalid category'));
		}
		$options = array ('conditions' => array ('Category.' . $this->Category->primaryKey => $id));
		$this->set ('category', $this->Category->find ('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add () {
		if ($this->request->is ('post')) {
			$this->Category->create ();
			if ($this->Category->save ($this->request->data)) {
				$this->Session->setFlash (__ ('The category has been saved.'));

				return $this->redirect (array ('action' => 'index'));
			} else {
				$this->Session->setFlash (__ ('The category could not be saved. Please, try again.'));
			}
		}
		$parents = $this->Category->ParentCategory->find ('list');
		$this->set (compact ('parents'));
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
		if (!$this->Category->exists ($id)) {
			throw new NotFoundException(__ ('Invalid category'));
		}
		if ($this->request->is (array ('post', 'put'))) {
			if ($this->Category->save ($this->request->data)) {
				$this->Session->setFlash (__ ('The category has been saved.'));

				return $this->redirect (array ('action' => 'index'));
			} else {
				$this->Session->setFlash (__ ('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array ('conditions' => array ('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find ('first', $options);
		}
		$parents = $this->Category->ParentCategory->find ('list');
		$this->set (compact ('parents'));
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
		$this->Category->id = $id;
		if (!$this->Category->exists ()) {
			throw new NotFoundException(__ ('Invalid category'));
		}
		$this->request->allowMethod ('post', 'delete');
		if ($this->Category->delete ()) {
			$this->Session->setFlash (__ ('The category has been deleted.'));
		} else {
			$this->Session->setFlash (__ ('The category could not be deleted. Please, try again.'));
		}

		return $this->redirect (array ('action' => 'index'));
	}
}
