<?php
defined('NS_PATH') or exit();
/**
 * Sphinx搜索引擎驱动
 * 
 */
ns_import('Sphinx.Sphinxapi', NS_PATH . 'Vendor', '.php');//引入sphinx、php接口

class SphinxDriver extends SphinxClient
{
	/**
	 * 重写SetServer方法在程序中可以使用 
	 *
	 */
	public function D_SetServer($host, $port = 0)
	{
		$this->SetServer($host, $port);
	}
	
	/**
	 * 重写SetConnectTimeout方法在程序中可以使用 
	 * 
	 */
	public function D_SetConnectTimeout($timeout)
	{
		if (assert(is_numeric($timeout))) {
			$this->SetConnectTimeout($timeout);
		} else {
			throw new Exception('time must be a number');
		}
	}
	
	/**
	 * 重写SetArrayResult方法在程序中可以使用 
	 * 
	 * @param array $arrayresult
	 */
	public function D_SetArrayResult($arrayresult)
	{
		$this->SetArrayResult($arrayresult);
	}
	
	/**
	 * 重写SetMatchMode方法在程序中可以使用 
	 * 
	 * @param const $mode
	 */
	public function D_SetMatchMode($mode)
	{
		assert(($mode==SPH_MATCH_ALL
			|| $mode==SPH_MATCH_ANY
			|| $mode==SPH_MATCH_PHRASE
			|| $mode==SPH_MATCH_BOOLEAN
			|| $mode==SPH_MATCH_EXTENDED
			|| $mode==SPH_MATCH_FULLSCAN
			|| $mode==SPH_MATCH_EXTENDED2) && is_numeric($mode));
		$this->SetMatchMode($mode);
	}
	
	/**
	 * 重写SetRankingMode方法在程序中可以使用 
	 * 
	 * @param unknown $ranker
	 * 
	 */
	public function D_SetRankingMode($ranker)
	{
		assert ( $ranker==SPH_RANK_PROXIMITY_BM25
		|| $ranker==SPH_RANK_BM25
		|| $ranker==SPH_RANK_NONE
		|| $ranker==SPH_RANK_WORDCOUNT
		|| $ranker==SPH_RANK_PROXIMITY );
		$this->SetRankingMode($ranker);
	}
	
	/**
	 * 重写SetFieldWeights方法在程序中可以使用 
	 * 
	 */
	public function D_SetFieldWeights($weights)
	{
		assert ( is_array($weights) );
		$this->SetFieldWeights($weights);
	}
	
	/**
	 * 重写SetSortMode方法在程序中可以使用 
	 * 
	 * 
	 */
	public function D_SetSortMode($mode, $sortby="")
	{
		$this->SetSortMode($mode, $sortby="");
	}
	
	/**
	 * 重写Query方法在程序中可以使用
	 *  
	 * @param mix $query - 搜索的参数值
	 * @param string $index
	 * @param string $comment
	 */
	public function D_Query($query, $index="*", $comment="")
	{
		$result = $this->Query($query, $index, $comment);
		return $result;
	}
	
	/**
	 * 设置搜索结果的limit实现分页
	 * 
	 */
	public function D_SetLimits($offset, $limit, $max=0, $cutoff=0)
	{
		$this->SetLimits($offset, $limit, $max=0, $cutoff=0);
	}
	
	/**
	 * 继承父类析构函数
	 * 
	 * (non-PHPdoc)
	 * @see SphinxClient::__destruct()
	 */
	public function __destruct()
	{
		parent::__destruct();
	}
	
}