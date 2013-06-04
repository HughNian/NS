<?php
class ContentModel extends ApiModel
{
	/**
	 * 测试用方法
	 * 
	 * 
	 */
	public function get(array $params)
	{
		$user_id = $username = null;
		extract($params);
		
		$result = array('user_id'=>$user_id, 'username'=>$username);
		return $this->returnResult(RE_SUCCESS, $result);
	}	
}