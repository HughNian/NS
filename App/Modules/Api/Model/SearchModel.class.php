<?php
class SearchModel extends ApiModel
{
	/**
	 * 获取搜索结果，并加密返回
	 * 
	 * @param array $params
	 * @return Ambigous <object;, stdClass>
	 */
	public function get(array $params)
	{
		$query = null;
		extract($params, EXTR_OVERWRITE);
		
		$this->_sphinx->D_SetServer (C('SPHINX_IP'), C('SPHINX_PORT'));
		$this->_sphinx->D_SetConnectTimeout ( 3 );
		$this->_sphinx->D_SetArrayResult ( true );
		$this->_sphinx->D_SetMatchMode ( SPH_MATCH_ANY);
		$result = $this->searchResult($query, "*");
		
		return $this->returnResult(RE_SUCCESS, $result);
	}
}