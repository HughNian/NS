<?php
class ApiModel extends CommonModel
{
	/**
	 * API模型层处理数据返回结果方法
	 * 
	 * @return object;
	 */
	public function returnResult($result, $data='')
	{
		$ret         = new stdClass;
		$ret->result = $result;
		$ret->data   = $data;
		return $ret;
	}
}