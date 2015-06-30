<?php
App::uses('AppController', 'Controller');
/**
 * Dashboard Controller
 *
 * @property Customer $Dashboard
 * @property PaginatorComponent $Paginator
 */
class DashboardController extends AppController {

	public $title_for_layout = 'Bảng điều khiển';
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
        $this->loadModel('Post');
        $posts = $this->Post->find('all',array(
			'conditions'=>array('Post.status'=>1),
            'order'=>array('Post.created' => 'DESC')
        ));
        $this->set(compact('posts'));
	}

}
