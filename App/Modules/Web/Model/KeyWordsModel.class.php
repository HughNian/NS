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
	
	public function getLikeKeyword($keyword)
	{
		$where['nums']    = array('gt', '10');
		$where['keyword'] = array('not in', $keyword);
		$where['_string'] = sprintf("keyword like '%%%s%%'", $keyword);
		$ret = $this->where($where)->field('keyword')->select();
		//echo $this->getLastSql();exit;
		return $ret;
	}
}