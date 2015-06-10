<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class PostsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("index", "view");      
	}
/**
 * home method
 *
 * @return void
 */
	public function admin_index() {
        $this->set('title', __('Posts'));        

		$this->paginate = array('order'=>array('Post.created' => 'DESC'));
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}
	
/**
 * index method
 *
 * @return void
 */
	public function admin_manage() {
        $this->set('title', __('Post'));
        $this->set('description', __('Manage Post'));
		
		$this->paginate = array('order'=>array('Post.created' => 'DESC'));
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
            $temp = array(
                'Post' => array(
                    'title' => 'lưu nháp',
                    'status' => '0'
                )
            );
            $data = $this->Post->find('first',array('conditions'=>array('Post.title like'=>'%lưu nháp%','Post.status'=>0)));
            if($data){
                $id = $data['Post']['id'];
            }else{
                $this->Post->save($temp);
                $id = $this->Post->id;
            }
            $this->redirect(Router::url(array('action'=>'edit',$id)));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data["Post"]["user_id"] = $this->Auth->user("id");
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved'), 'success');
				$this->redirect(array('action' => 'manage'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Post->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'), 'error');
		}
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('Post deleted'), 'error');
			$this->redirect(array('action' => 'manage'));
		}
		$this->Session->setFlash(__('Post was not deleted'), 'success');
		$this->redirect(array('action' => 'manage'));
	}
}
