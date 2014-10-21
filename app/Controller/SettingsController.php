<?php
App::uses('AppController', 'Controller');
/**
 * Settings Controller
 *
 */
class SettingsController extends AppController {

	public $components = array('Paginator');
	public $title_for_layout = 'Tuỳ chỉnh';
	/**
	 * Admin index
	 *
	 * @return void
	 * @access public
	 */
	public function admin_index() {
		$this->Setting->recursive = 0;
		$this->set('settings', $this->Paginator->paginate());
	}

	/**
	 * Admin view
	 *
	 * @param view $id
	 * @return void
	 * @access public
	 */
	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__( 'Invalid Setting.'), 'default', array('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->set('setting', $this->Setting->read(null, $id));
	}

	/**
	 * Admin add
	 *
	 * @return void
	 * @access public
	 */
	public function admin_add() {

		if (!empty($this->request->data)) {
			$this->Setting->create();
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__( 'The Setting has been saved'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__( 'The Setting could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$type = $this->Setting->getType();
		$jsontype = json_encode($type);
		$this->set(compact('jsontype'));
	}

	/**
	 * Admin edit
	 *
	 * @param integer $id
	 * @return void
	 * @access public
	 */
	public function admin_edit($id = null) {

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__( 'Invalid Setting'), 'default', array('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__( 'The Setting has been saved'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__( 'The Setting could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Setting->read(null, $id);
		}
		$type = $this->Setting->getType();
		$jsontype = json_encode($type);
		$this->set(compact('jsontype'));
	}

	/**
	 * Admin delete
	 *
	 * @param integer $id
	 * @return void
	 * @access public
	 */
	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__( 'Invalid id for Setting'), 'default', array('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->Setting->delete($id)) {
			$this->Session->setFlash(__( 'Setting deleted'), 'default', array('class' => 'success'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	/**
	 * Admin prefix
	 *
	 * @param string $prefix
	 * @return void
	 * @access public
	 */
	public function prefix($prefix = null) {

		$this->Setting->Behaviors->attach('Croogo.Params');
		if (!empty($this->request->data) && $this->Setting->saveAll($this->request->data['Setting'])) {
			$this->Session->setFlash(__( "Settings updated successfully"), 'default', array('class' => 'success'));
			return $this->redirect(array('action' => 'prefix', $prefix));
		}

		$settings = $this->Setting->find('all', array(
													 'order' => 'Setting.weight ASC',
													 'conditions' => array(
														 'Setting.key LIKE' => $prefix . '.%'
													 ),
												));
		$this->set(compact('settings'));

		if (count($settings) == 0) {
			$this->Session->setFlash(__( "Invalid Setting key"), 'default', array('class' => 'error'));
		}

		$this->set("prefix", $prefix);
	}


}
