<?php
class ApiModel extends CommonModel
{
	protected $_sphinx = null;
	
	public function __construct()
	{
		$this->_sphinx = new SphinxDriver();//实例化sphinx搜索引擎对象
	}
	
	/**
	 * 通过sphinx搜索引擎搜索结果
	 * 
	 * @param mix $query - 需要搜索的参数值
	 * @param string $index
	 * @param string $comment
	 * @return Ambigous <boolean, multitype:>
	 */
	public function searchResult($query, $index="*", $comment="")
	{
		$result = $this->_sphinx->D_Query($query, $index="*", $comment="");
		return $result;	
	}
	
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