<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
            'Session',
            'Auth' => array(
								'loginRedirect' => array('admin'=>true,'controller' => 'dashboard', 'action' => 'index'),
								'logoutRedirect' => array('admin'=>true,'controller' => 'users', 'action' => 'login'),
								'authError' => 'You must be logged in to view this page.',
								'loginError' => 'Invalid Username or Password entered, please try again.',
								'authenticate' => array(
                                    'Form' => array(
                                        'scope'  => array('User.status' => 1)
                                    ),
								),
								'authorize' => array(
									'Actions' => array('actionPath' => 'controllers')
								)
    						),
			'Menu'
	);
	public $uses = array('Setting');
    // only allow the login controllers only
    public function beforeFilter() {
        $this->Auth->allow('login');
		if(isset($this->title_for_layout)){$this->set('title_for_layout',$this->title_for_layout);}
		$statuses = array(
			0 => 'Chưa kích hoạt',
			1 => 'Kích hoạt',
		);
		$this->set(compact('statuses'));
        if($this->Session->read('Auth.User.id') == 8){
            $this->Toolbar = $this->Components->load('DebugKit.Toolbar');
        }
        $this->loadModel('Post');
        $news = $this->Post->find('all',array(
            'fields'=>array('Post.id','Post.title','Post.type'),
            'conditions'=>array('Post.status'=>1),
            'recursive'=>-1,
            'limit'=> 5,
            'order'=>array('Post.created' => 'DESC')
        ));
        if($news){
            $news = $news[array_rand(array_keys($news),1)];
            $this->set(compact('news'));
        }
        parent::beforeFilter();
    }

    public function isAuthorized($user) {
        // Here is where we should verify the role and give access based on role
//        return true;
    }
	public function render($view = null, $layout = null) {
        if(!$this->request->isAjax()){
            list($plugin, ) = pluginSplit(App::location(get_parent_class($this)));
            if ($plugin) {
                App::build(array(
                    'View' => array(
                        CakePlugin::path($plugin) . 'View' . DS,
                    ),
                ), App::APPEND);
            }

            if (strpos($view, '/') !== false || $this instanceof CakeErrorController) {
                return parent::render($view, $layout);
            }
            $viewPaths = App::path('View', $this->plugin);
            $rootPath = $viewPaths[0] . $this->viewPath . DS;
            $requested = $rootPath . $view . '.ctp';
            if (in_array($this->request->action, array('admin_edit', 'admin_add', 'edit', 'add'))) {
                $viewPath = $rootPath . $this->request->action . '.ctp';
                if (!file_exists($requested) && !file_exists($viewPath)) {
                    if (strpos($this->request->action, 'admin_') === false) {
                        $view = 'form';
                    } else {
                        $view = 'admin_form';
                    }
                }
            }
            return parent::render($view, $layout);
        }else{
            return parent::render($view, $layout);
        }
	}
    public function canUploadMedias($model, $id){
//        if($model == 'User' & $id = $this->Session->read('Auth.User.id')){
//            return true; // Everyone can edit the medias for their own record
//        }
//        return $this->Session->read('Auth.User.role') == 'admin'; // Only admins can upload medias for everything else
        return true;
    }
    public function make_slug($text)
    {
        $text = preg_replace('/ä|æ|ǽ/', 'ae', $text);
        $text = preg_replace('/ö|œ/', 'oe', $text);
        $text = preg_replace('/ü/', 'ue', $text);
        $text = preg_replace('/Ä/', 'Ae', $text);
        $text = preg_replace('/Ü/', 'Ue', $text);
        $text = preg_replace('/Ö/', 'Oe', $text);
        $text = preg_replace('/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/', 'A', $text);
        $text = preg_replace('/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/', 'a', $text);
        $text = preg_replace('/Ç|Ć|Ĉ|Ċ|Č/', 'C', $text);
        $text = preg_replace('/ç|ć|ĉ|ċ|č/', 'c', $text);
        $text = preg_replace('/Ð|Ď|Đ/', 'D', $text);
        $text = preg_replace('/ð|ď|đ/', 'd', $text);
        $text = preg_replace('/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/', 'E', $text);
        $text = preg_replace('/è|é|ê|ë|ē|ĕ|ė|ę|ě|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/', 'e', $text);
        $text = preg_replace('/Ĝ|Ğ|Ġ|Ģ/', 'G', $text);
        $text = preg_replace('/ĝ|ğ|ġ|ģ/', 'g', $text);
        $text = preg_replace('/Ĥ|Ħ/', 'H', $text);
        $text = preg_replace('/ĥ|ħ/', 'h', $text);
        $text = preg_replace('/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Ì|Í|Ị|Ỉ|Ĩ/', 'I', $text);
        $text = preg_replace('/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|ì|í|ị|ỉ|ĩ/', 'i', $text);
        $text = preg_replace('/Ĵ/', 'J', $text);
        $text = preg_replace('/ĵ/', 'j', $text);
        $text = preg_replace('/Ķ/', 'K', $text);
        $text = preg_replace('/ķ/', 'k', $text);
        $text = preg_replace('/Ĺ|Ļ|Ľ|Ŀ|Ł/', 'L', $text);
        $text = preg_replace('/ĺ|ļ|ľ|ŀ|ł/', 'l', $text);
        $text = preg_replace('/Ñ|Ń|Ņ|Ň/', 'N', $text);
        $text = preg_replace('/ñ|ń|ņ|ň|ŉ/', 'n', $text);
        $text = preg_replace('/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/', 'O', $text);
        $text = preg_replace('/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/', 'o', $text);
        $text = preg_replace('/Ŕ|Ŗ|Ř/', 'R', $text);
        $text = preg_replace('/ŕ|ŗ|ř/', 'r', $text);
        $text = preg_replace('/Ś|Ŝ|Ş|Š/', 'S', $text);
        $text = preg_replace('/ś|ŝ|ş|š|ſ/', 's', $text);
        $text = preg_replace('/Ţ|Ť|Ŧ/', 'T', $text);
        $text = preg_replace('/ţ|ť|ŧ/', 't', $text);
        $text = preg_replace('/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/', 'U', $text);
        $text = preg_replace('/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/', 'u', $text);
        $text = preg_replace('/Ý|Ÿ|Ŷ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/', 'Y', $text);
        $text = preg_replace('/ý|ÿ|ŷ|ỳ|ý|ỵ|ỷ|ỹ/', 'y', $text);
        $text = preg_replace('/Ŵ/', 'W', $text);
        $text = preg_replace('/ŵ/', 'w', $text);
        $text = preg_replace('/Ź|Ż|Ž/', 'Z', $text);
        $text = preg_replace('/ź|ż|ž/', 'z', $text);
        $text = preg_replace('/Æ|Ǽ/', 'AE', $text);
        $text = preg_replace('/ß/', 'ss', $text);
        $text = preg_replace('/Ĳ/', 'IJ', $text);
        $text = preg_replace('/ĳ/', 'ij', $text);
        $text = preg_replace('/Œ/', 'OE', $text);
        $text = preg_replace('/ƒ/', 'f', $text);
        // Cyrillic Letters
        $text = preg_replace('/А/', 'A', $text);
        $text = preg_replace('/Б/', 'B', $text);
        $text = preg_replace('/В/', 'V', $text);
        $text = preg_replace('/Г/', 'G', $text);
        $text = preg_replace('/Д/', 'D', $text);
        $text = preg_replace('/Е/', 'E', $text);
        $text = preg_replace('/Ё/', 'YO', $text);
        $text = preg_replace('/Ж/', 'ZH', $text);
        $text = preg_replace('/З/', 'Z', $text);
        $text = preg_replace('/И/', 'I', $text);
        $text = preg_replace('/Й/', 'Y', $text);
        $text = preg_replace('/К/', 'K', $text);
        $text = preg_replace('/Л/', 'L', $text);
        $text = preg_replace('/М/', 'M', $text);
        $text = preg_replace('/Н/', 'N', $text);
        $text = preg_replace('/О/', 'O', $text);
        $text = preg_replace('/П/', 'P', $text);
        $text = preg_replace('/Р/', 'R', $text);
        $text = preg_replace('/С/', 'S', $text);
        $text = preg_replace('/Т/', 'T', $text);
        $text = preg_replace('/У/', 'U', $text);
        $text = preg_replace('/Ф/', 'F', $text);
        $text = preg_replace('/Х/', 'H', $text);
        $text = preg_replace('/Ц/', 'TS', $text);
        $text = preg_replace('/Ч/', 'CH', $text);
        $text = preg_replace('/Ш/', 'SH', $text);
        $text = preg_replace('/Щ/', 'SH', $text);
        $text = preg_replace('/Ъ/', '', $text);
        $text = preg_replace('/Ы/', 'Y', $text);
        $text = preg_replace('/Ь/', '', $text);
        $text = preg_replace('/Э/', 'E', $text);
        $text = preg_replace('/Ю/', 'YU', $text);
        $text = preg_replace('/Я/', 'YA', $text);
        $text = preg_replace('/а/', 'a', $text);
        $text = preg_replace('/б/', 'b', $text);
        $text = preg_replace('/в/', 'v', $text);
        $text = preg_replace('/г/', 'g', $text);
        $text = preg_replace('/д/', 'd', $text);
        $text = preg_replace('/е/', 'e', $text);
        $text = preg_replace('/ё/', 'yo', $text);
        $text = preg_replace('/ж/', 'zh', $text);
        $text = preg_replace('/з/', 'z', $text);
        $text = preg_replace('/и/', 'i', $text);
        $text = preg_replace('/й/', 'y', $text);
        $text = preg_replace('/к/', 'k', $text);
        $text = preg_replace('/л/', 'l', $text);
        $text = preg_replace('/м/', 'm', $text);
        $text = preg_replace('/н/', 'n', $text);
        $text = preg_replace('/о/', 'o', $text);
        $text = preg_replace('/п/', 'p', $text);
        $text = preg_replace('/р/', 'r', $text);
        $text = preg_replace('/с/', 's', $text);
        $text = preg_replace('/т/', 't', $text);
        $text = preg_replace('/у/', 'u', $text);
        $text = preg_replace('/ф/', 'f', $text);
        $text = preg_replace('/х/', 'h', $text);
        $text = preg_replace('/ц/', 'ts', $text);
        $text = preg_replace('/ч/', 'ch', $text);
        $text = preg_replace('/ш/', 'sh', $text);
        $text = preg_replace('/щ/', 'sh', $text);
        $text = preg_replace('/ъ/', '', $text);
        $text = preg_replace('/ы/', 'y', $text);
        $text = preg_replace('/ь/', '', $text);
        $text = preg_replace('/э/', 'e', $text);
        $text = preg_replace('/ю/', 'yu', $text);
        $text = preg_replace('/я/', 'ya', $text);

        $text = preg_replace('/\s+/', '-', $text);
        $text = preg_replace('/[^a-zA-Z0-9\-]/', '', $text);
        $text = preg_replace('/\-{2,}/', '-', $text);
        $text = preg_replace('/\-$/', '', $text);
        $text = preg_replace('/^\-/', '', $text);
        $text = strtolower($text);

        return $text;
    }
}
