<?php
//公共函数
/**
 * 把url中的query_string转化成数组
 * 
 * 如user_id=2&token=fksndflkdsahgkdsah 转化成 array(user_id => 2, token => 'fksndflkdsahgkdsah');
 * 
 * @return array;
 */
function Url2Array($url)
{
	if(!is_string($url)) return;
	$urls = explode('&', $url);
	
	foreach($urls as $key => $val) {
		static $urlarray = array();
		$key        = strstr($val, '=', true);
		$val        = substr(strstr($val, '='),1);
		if($val == "") {
			$urlarray = false;
			break;
		} else {
			$urlarray[$key] = $val;
		}
	}
	return $urlarray;
}