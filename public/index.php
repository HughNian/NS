<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_STRICT ^ E_DEPRECATED);

// set default timezone
date_default_timezone_set('Asia/ShangHai');

define('APP_NAME', 'App');
define('WEB_ROOT') or define('WEB_ROOT', realpath(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR);
define('APP_PATH')
	|| define('APP_PATH', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . APP_NAME) . DIRECTORY_SEPARATOR);
define('APPLICATION_PATH')
	|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . APP_NAME . '/Modules/Application/'));
define('ADMIN_PATH')
	|| define('ADMIN_PATH', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . APP_NAME . '/Modules/Admin/'));
define('API_PATH')
	|| define('API_PATH', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . APP_NAME . '/Modules/API/'));

defined('APP_DEBUG') 	or define('APP_DEBUG',true);

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
	realpath(realpath(dirname(__FILE__)) . '/../library'),
	get_include_path(),
)));

// 加载Ns套框架入口文件
require("/Ns/Ns.php");

// 加载框架入口文件
require( "/Tlib/ThinkPHP.php");