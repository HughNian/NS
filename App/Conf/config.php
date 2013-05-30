<?php
return array(
	'URL_ROUTER_ON'             => false, //开启路由
    'URL_MODEL'                 =>  1, // 如果你的环境不支持PATHINFO 请设置为3
	'URL_CASE_INSENSITIVE'      =>  true,
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  'localhost',
    'DB_NAME'                   =>  'group',
    'DB_USER'                   =>  'root',
    'DB_PWD'                    =>  '123456',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  'think_',
    'APP_GROUP_LIST'            =>  'Home,Admin',
    'DEFAULT_GROUP'             =>  'Home',
    'APP_GROUP_MODE'            =>  1,
    'SHOW_PAGE_TRACE'           =>  0,//显示调试信息 
    'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
	'TMPL_CACHE_ON'             =>  1 //是否开启模板缓存
);
