<?php
class KeyWordsModel extends WebModel
{
	protected $trueTableName = 'ns_keywords';
	
	public function addKeyWord($keyword)
	{
		$keyword_exists = $this->keywordExists($keyword);
		
		$data = array();
		if($keyword_exists == null) {
			$data['keyword']       = $keyword;
			$data['nums']    = 1;
			$data['create_time']   = array('exp', 'UNIX_TIMESTAMP()');
			$ret = $this->add($data);
		} else {
			$data['nums']           = array('exp', 'nums+1');
			$data['create_time']    = array('exp', 'UNIX_TIMESTAMP()');
			$ret = $this->where('id = ' . $keyword_exists[0]['id'])->save($data);
		}
		//echo $this->getLastSql();exit;
		return $ret;
	}
	
	private function keywordExists($keyword)
	{
		$where['keyword'] = $keyword;
		$ret = $this->where($where)->select();
		//echo $this->getLastSql();exit;
		return $ret;
	}
	
	/**
	 * 相关搜索的关键词(旧),利用mysql查找
	 * 
	 * @param {string} $keyword
	 * @return Ambigous <mixed, boolean, NULL, string, unknown, multitype:, multitype:multitype: , void, object>
	 */
	public function getLikeKeyword($keyword)
	{
		$where['nums']    = array('gt', '10');
		$where['keyword'] = array('not in', $keyword);
		$where['_string'] = sprintf("keyword like '%%%s%%'", $keyword);
		$ret = $this->where($where)->field('keyword')->select();
		//echo $this->getLastSql();exit;
		return $ret;
	}
	
	/**
	 * 相关搜索的关键词(新),利用sphinx查找相关搜索关键词,同时加入memcache缓存以减少资源消耗，加快系统速度
	 * 
	 * 
	 */
	public function getLinkKeywords($keyword)
	{
		$like_keywords_json = $this->_memcached->get($keyword);
		
		if(empty($like_keywords_json)) {
			$sphinx = $this->runSphinx();
			$keywords = $sphinx->D_Query($keyword, 'keywords');
			$like_keywords = array();
			foreach($keywords['matches'] as $key => $val) {
				$key_word = $this->where('id = ' . $val['id'] . ' AND nums > 10 AND `keyword` NOT IN ("' . $keyword . '")')->field('keyword, nums')->select();
				$like_keywords[$key] = 	$key_word[0];
				if($like_keywords[$key] == "") unset($like_keywords[$key]);
				if($like_keywords[$key]['nums'] > $like_keywords[$key+1]['nums']) {
					$like_keywords[$key];
				}
			}
			$like_keywords = likeKeywordOrder($like_keywords);
			
			$this->_memcached->set($keyword, json_encode($like_keywords));
		} else {
			$like_keywords = json_decode($like_keywords_json, true);
		}
		
		return $like_keywords;
	}
}