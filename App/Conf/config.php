<?php
return array(
	'URL_ROUTER_ON'             => true,                                          //开启路由
	'URL_ROUTE_RULES'           => array(//定义路由规则
									'api'    => 'Api/Index/index',
									'search' => 'Api/Index/index/search',			  
								),
    'URL_MODEL'                 =>  1,                                            // 如果你的环境不支持PATHINFO 请设置为3
	'URL_CASE_INSENSITIVE'      =>  true,
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  'localhost',
    'DB_NAME'                   =>  'ns',
    'DB_USER'                   =>  'root',
    'DB_PWD'                    =>  '123456',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  'ns_',
    'APP_GROUP_LIST'            =>  'Api,Admin,Web',
    'DEFAULT_GROUP'             =>  'Web',
    'APP_GROUP_MODE'            =>  1,
    'SHOW_PAGE_TRACE'           =>  0,                                            //显示调试信息 
    'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
	'TMPL_CACHE_ON'             =>  1,                                            //是否开启模板缓存
	'WEB_TITLE'                 =>  '站内搜索引擎',                                   //全站title名
	'API_KEY'					=>  '2y14UjuWD6XzicGr27x2shSh',   				  //api加密key
	'API_IV'                    =>  '12345678',                                   //api加密iv
	'API_TYPE'                  =>  'json',                                       //默认api接口返回数据类型为json
	'SPHINX_PORT'               =>  9312,                                         //sphinx搜索引擎服务器端口号
	'SPHINX_IP'                 =>  '127.0.0.1',                                  //sphinx搜索引擎服务器ip
	'API_SEARCH_URL'            =>  'http://www.ns.com/api/search/get.json',      //搜索api链接,json格式返回
);