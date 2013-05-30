<?php
// +----------------------------------------------------------------------
// | Ns套框架(ThinkPHP)程序入口文件
// +----------------------------------------------------------------------
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

define('NS_PATH')
	|| define('NS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('NS_ACTION_PATH')//NS套框架控制器目录
	|| define('NS_ACTION_PATH', NS_PATH . 'Action' . DIRECTORY_SEPARATOR);
define('NS_GD_PATH')//NS套框GD库目录
	|| define('NS_GD_PATH', NS_PATH . 'Gd' . DIRECTORY_SEPARATOR);
define('NS_CRYPT_PATH')//NS套框架加密类目录
	|| define('NS_CRYPT_PATH', NS_PATH . 'Crypt' . DIRECTORY_SEPARATOR);
define('NS_MODEL_PATH')//NS套框架模型目录
	|| define('NS_MODEL_PATH', NS_PATH . 'Model' . DIRECTORY_SEPARATOR);
define('NS_CORE_PATH')//NS套框架核心目录
	|| define('NS_CORE_PATH', NS_PATH . 'Core' . DIRECTORY_SEPARATOR);
define('NS_NET_PATH')//NS套框架Net目录
	|| define('NS_NET_PATH', NS_PATH . 'Net' . DIRECTORY_SEPARATOR);
define('NS_WEB_PATH')//NS套框架Web目录
	|| define('NS_WEB_PATH', NS_PATH . 'Web' . DIRECTORY_SEPARATOR);
define('NS_DRIVER_PATH')//NS套框架Dirver目录
	|| define('NS_DRIVER_PATH', NS_PATH . 'Driver' . DIRECTORY_SEPARATOR);
//define('TP_PATH')
	//|| define('TP_PATH', WEB_ROOT . 'library' . DIRECTORY_SEPARATOR . 'Tlib' . DIRECTORY_SEPARATOR);

require(NS_CORE_PATH . 'NianSong.php');

Ns::run();