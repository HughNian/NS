<?php
class ContentModel extends ApiModel
{
	/**
	 * 测试用方法
	 * 
	 */
	public function get(array $params)
	{
		//测试加密值 KIb6skTwg6J8bF7%2FyJUKSe7%2B%2FFfxc2Wa4JRNd0SE4jh4EwEZbwDbWm4x4%2FPGYg7unqnrd8Csxq0%3D
		$user_id = $username = null;
		extract($params, EXTR_OVERWRITE);
		
		$result = array('user_id'=>$user_id, 'username'=>$username);
		return $this->returnResult(RE_SUCCESS, $result);
	}
}