<?php
class FilesController extends AppController {

	public function beforeFilter()
	{
		parent::beforeFilter();
	}
	public function admin_index() {
		debug($this->request);die;
	}
	public function connector(){

	}
}