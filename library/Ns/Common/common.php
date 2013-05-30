<?php
/**
 * Ns 套框架基础函数库
 * 
 */

/**
 * 优化的require_once
 * @param string $filename 文件地址
 * @return boolean
 */
function ns_require_cache($filename) 
{
	static $_importFiles = array();
	if (!isset($_importFiles[$filename])) {
		if (ns_file_exists_case($filename)) {
			require $filename;
			$_importFiles[$filename] = true;
		} else {
			$_importFiles[$filename] = false;
		}
	}
	return $_importFiles[$filename];
}

/**
 * 批量导入文件 成功则返回
 * @param array $array 文件数组
 * @param boolean $return 加载成功后是否返回
 * @return boolean
 */
function ns_require_array($array,$return=false)
{
	foreach ($array as $file) {
		if (ns_require_cache($file) && $return) return true;
	}
	if($return) return false;
}

/**
 * 区分大小写的文件存在判断
 * @param string $filename 文件地址
 * @return boolean
 */
function ns_file_exists_case($filename) 
{
	if (is_file($filename)) {
		if (APP_FILE_CASE) {
			if (basename(realpath($filename)) != basename($filename))
				return false;
		}
		return true;
	}
	return false;
}

/**
 * 导入所需的类库 同java的Import 本函数有缓存功能
 * @param string $class 类库命名空间字符串
 * @param string $baseUrl 起始路径
 * @param string $ext 导入的文件扩展名
 * @return boolean
 */
function ns_import($class, $baseUrl = '', $ext='.class.php') {
	$class = str_replace(array('.', '#'), array('/', '.'), $class);
	$class_strut     = explode('/', $class);

	if (empty($baseUrl)) {
		$libPath    =   defined('BASE_LIB_PATH')?BASE_LIB_PATH:LIB_PATH;
		if ('@' == $class_strut[0] || APP_NAME == $class_strut[0]) {
			//加载当前项目应用类库
			$baseUrl = dirname($libPath);
			$class   = substr_replace($class, basename($libPath).'/', 0, strlen($class_strut[0]) + 1);
		}elseif ('think' == strtolower($class_strut[0])){ // think 官方基类库
			$baseUrl = CORE_PATH;
			$class   = substr($class,6);
		}elseif (in_array(strtolower($class_strut[0]), array('org', 'com'))) {
			// org 第三方公共类库 com 企业公共类库
			$baseUrl = LIBRARY_PATH;
		}else { // 加载其他项目应用类库
			$class   = substr_replace($class, '', 0, strlen($class_strut[0]) + 1);
			$baseUrl = APP_PATH . '../' . $class_strut[0] . '/'.basename($libPath).'/';
		}
	}
	if (substr($baseUrl, -1) != '/')
		$baseUrl    .= '/';
	$classfile       = $baseUrl . $class . $ext;
	if (!class_exists(basename($class),false)) {
		// 如果类不存在 则导入类库文件
		return require_cache($classfile);
	}
}