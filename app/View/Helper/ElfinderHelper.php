<?php
App::uses('AppHelper', 'View/Helper');
class ElfinderHelper extends AppHelper {
	public $helpers = array('Js', 'Html');

	function loadLibs() {
		return $this->Html->css(
			array(
				 "/lib/elfinder/css/elfinder.min",
				 "/lib/elfinder/css/theme",
			))
		.$this->Html->script(
			array(
				 "/lib/elfinder/js/elfinder.min",
			), array("inline"=>false,'block' => 'scriptBottom'));
	}

	function loadFinder($url){
		$code = "$(document).ready(function(){
                    var f = $('#finder').elfinder({
                        url : '".$url."', 
                        lang: 'no',
                        docked : false,
                        height: 600
                    }).elfinder('instance');     
                }); ";
//		return $code;
		return $this->Html->scriptBlock($code, array("inline"=>false,'block' => 'scriptBottom'));
	}
}
?>