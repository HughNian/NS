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
		$query = $offset = $limit = null;
		extract($params, EXTR_OVERWRITE);
		
		$opts = array(
				"before_match"          => "<font color='#D50000'>",
				"after_match"           => "</font>",
				"chunk_separator"       => "...",
				"limit"                 => 100,
				"around"                => 60,
		);
		
		$this->_sphinx->D_SetServer (C('SPHINX_IP'), C('SPHINX_PORT'));
		$this->_sphinx->D_SetConnectTimeout ( 3 );
		$this->_sphinx->D_SetArrayResult ( true );
		$this->_sphinx->D_SetMatchMode (SPH_MATCH_EXTENDED);
		$this->_sphinx->D_SetRankingMode (SPH_RANK_PROXIMITY);//设置评分模式
		$this->_sphinx->D_SetFieldWeights (array('title'=>1,'desc'=>2,'price'=>3));//设置字段的权重
		$this->_sphinx->D_SetSortMode ('SPH_SORT_EXPR','@weight');//按照权重排序
		$this->_sphinx->D_SetLimits ($offset, $limit);
		$result = $this->searchResult($query, "*");
		foreach($result['matches'] as $key => $val) {
			static $ids = array();
			$ids[]      = $val['id'];
		}
		
		$product = new ProductModel();
		$datas   = $product->getSearchDatas($ids);
		$titles  = $des = $real_data = array();
		/*
		foreach($datas as $key => $val) {
			$titles[$key] = $val[0]['title'];
			$des[$key]    = $val[0]['des'];
		}*/
		
		foreach($datas as $key => $val) {
			foreach($val[0] as $k => $v) {
				$real_data[$key][$k]  = $this->_sphinx->buildExcerpts(array($v), 'mysql', $query, $opts);
				$real_data['total']   = $result['total'];
				$real_data['total_found'] = $result['total_found'];
			}
		}
		
		//$real_data['title'] = $this->_sphinx->buildExcerpts($titles, 'mysql', $query, $opts);
		//$real_data['des']   = $this->_sphinx->buildExcerpts($des, 'mysql', $query, $opts);
		//echo $this->_sphinx->GetLastError();返回sphinx抛出的错误
		
		return $this->returnResult(RE_SUCCESS, $real_data);
	}
}