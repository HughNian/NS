<?php
//公共函数
function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty ( $time )) {
		return '';
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}

/**
 * 对相关搜索关键词排序，按搜索量从高到低排序
 * 
 * @param  {array} $likekeyword
 * @return {array} $likekeywordorder
 */
function likeKeywordOrder($likekeyword = array())
{
	$nums = array();
	$likekeywordorder = array();
	if(count($likekeyword) != 0) {
		foreach($likekeyword as $key => $val) {
			$nums[$key] = $val['nums'];
		}	
	}
	arsort($nums);
	$nums_keys = array_keys($nums);
	$keys = array_keys($nums);
	for($i=0; $i<count($nums); $i++) {
		$likekeywordorder[$i] = $likekeyword[$nums_keys[$i]];
	}
	return $likekeywordorder;
}