<?php
class ApiAction extends CommonAction
{
	private $_crypt = null;
	
	public function _initialize()
	{
		parent::_initialize();
		$this->_crypt = new TripleDesCrypt(C('API_KEY'), C('API_IV'));
	}
	
	/**
	 * Api接口返回数据方法,将要返回的数据生成json
	 * 
	 */
	public function __toJson($result, $internal)
	{
		$data = array();
		if ($result == RC_SUCCESS) {
			$data['internal'] = $internal;
			$data = json_encode($data);
			$data = $this->_crypt->encrypt($data);
		} else {
			$data = '';
		}
		
		$arrReturn = array(
				'result' => $result,
				'data'   => $data,
		);
		return json_encode($arrReturn);
	}
	
	/**
	 * 根据模板直接输出json，不需要在Controller中再重新写assign,display
	 * 
	 * 
	 */
	public function __echoJson($result, $data='')
	{
		$json = $this->__toJson($result, $data);
		//assign
		$this->_view->_assign('json', $json);
		//display
		//$this->_view->_display('index.tpl');
	}
}