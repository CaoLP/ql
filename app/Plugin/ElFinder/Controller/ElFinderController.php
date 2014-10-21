<?php

App::uses('ElFinderAppController', 'ElFinder.Controller');

/**
 * ElFinder Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Paul Gardner <phpmagpie@webbedit.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ElFinderController extends ElFinderAppController {

	public $title_for_layout = 'Quản lý file';
/**
 * admin_index
 *
 * @return void
 */
	public function index() {
	}
	public function browse() {
		$this->layout='browse';
	}
	public function connector(){

//		echo WWW_ROOT.'uploads';
		App::import('Vendor', 'ElFinder.elFinder/elFinderConnector.class');
		App::import('Vendor', 'ElFinder.elFinder/elFinder.class');
		App::import('Vendor', 'ElFinder.elFinder/elFinderVolumeDriver.class');
		App::import('Vendor', 'ElFinder.elFinder/elFinderVolumeLocalFileSystem.class');

		$opts = array(
			// 'debug' => true,
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
					'path'          => WWW_ROOT.'uploads',         // path to files (REQUIRED)
					'URL'           => base_URL.'/uploads/', // URL to files (REQUIRED)
					'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL)
					 'fileMode'     => 0777,         // new files mode
					 'dirMode'      => 0777,         // new folders mode
					 'tmbPath'         => 'tmb',
				)
			)
		);

		// run elFinder
		$connector = new ElFinderConnector(new ElFinder($opts));
		$connector->run();
	}
	public function admin_index() {
	}
	public function admin_browse() {
		$this->layout='browse';
	}
	public function admin_connector(){

		//		echo WWW_ROOT.'uploads';
		App::import('Vendor', 'ElFinder.elFinder/elFinderConnector.class');
		App::import('Vendor', 'ElFinder.elFinder/elFinder.class');
		App::import('Vendor', 'ElFinder.elFinder/elFinderVolumeDriver.class');
		App::import('Vendor', 'ElFinder.elFinder/elFinderVolumeLocalFileSystem.class');

		$opts = array(
			// 'debug' => true,
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
					'path'          => WWW_ROOT.'uploads',         // path to files (REQUIRED)
					'URL'           => base_URL.'/uploads/', // URL to files (REQUIRED)
					'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL)
					'fileMode'     => 0777,         // new files mode
					'dirMode'      => 0777,         // new folders mode
					'tmbPath'         => 'tmb',
				)
			)
		);

		// run elFinder
		$connector = new ElFinderConnector(new ElFinder($opts));
		$connector->run();
	}
}
