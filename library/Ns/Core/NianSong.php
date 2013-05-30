<?php
/**
 * Ns套框架 Portal类
 * 
 */
class Ns
{
	static public function run()
	{
		define('APP_FILE_CASE') or define('APP_FILE_CASE', false);
		require (NS_PATH . "Common" . DIRECTORY_SEPARATOR . 'common.php');
		spl_autoload_register(array('Ns', 'autoload'));
	}
	
	/**
	 * Ns套框架自动加载类
	 * 
	 */
	static public function autoload($class)
	{
		$file = $class . '.php';
		if(substr($class, -6) == 'Action') {//加载Action
			if(ns_require_array(array(
					NS_ACTION_PATH . $file,
					), true)){
				return;
			};
		} else if (substr($class, -2) == 'Gd') {//加载Gd
			if(ns_require_array(array(NS_GD_PATH . $file), true)) {
				return;
			};
		} else if (substr($class, -5) == 'Model') {//加载Model
			if(ns_require_array(array(NS_MODEL_PATH . $file), true)) {
				return;
			};
		} else if (substr($class, -3) == 'Net') {//加载Net
			if(ns_require_array(array(NS_NET_PATH . $file), true)) {
				return;
			};
		} else if (substr($class, -3) == 'Web') {//加载Web
			if(ns_require_array(array(NS_WEB_PATH . $file), true)) {
				return;
			};
		}  else if (substr($class, -6) == 'Driver') {//加载Dirver驱动目录
			if(ns_require_array(array(NS_DRIVER_PATH . $file), true)) {
				return;
			};
		} else {//加载NS套框架根目录下类库
			if(ns_require_array(array(NS_PATH . $file), true)) {
				return;
			}
		}
	}
}