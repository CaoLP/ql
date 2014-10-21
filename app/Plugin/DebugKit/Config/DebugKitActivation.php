<?php
/**
 * Seo Activation
 *
 * Activation class for Seo plugin.
 *
 * @package  Croogo
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class DebugKitActivation {

	public $version = '1.0';
/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeActivation(&$controller) {
        return true;
    }
/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onActivation(&$controller) {
        // ACL: set ACOs with permissions
        $controller->Croogo->addAco('DebugKit');
    }
/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeDeactivation(&$controller) {
        return true;
    }
/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onDeactivation(&$controller) {
        // ACL: remove ACOs with permissions
        $controller->Croogo->removeAco('DebugKit'); // ExampleController ACO and it's actions will be removed
    }
}
?>