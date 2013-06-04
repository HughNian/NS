<?php
class ApiAction extends CommonAction
{
	private $_crypt   = null;
	
	public function _initialize()
	{
		parent::_initialize();
		$this->_crypt   = new TripleDesCrypt(C('API_KEY'), C('API_IV'), false);
	}
	
	/**
	 * Api接口返回数据方法,将要返回的数据生成json
	 * 
	 */
	public function __toJson($result, $internal)
	{
		$data = array();
		if ($result == RE_SUCCESS) {
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
	 * Api接口返回数据方法,将要返回的数据生成xml
	 * 
	 */
	public function __toXml($result, $internal)
	{
		
	}
	
	/**
	 * 根据模板直接输出json，不需要在Controller中再重新写assign,display
	 * 
	 * 
	 */
	public function __echoRet($result, $data='')
	{
		if(C('API_TYPE') == 'json') {
			$json = $this->__toJson($result, $data);
			echo $json;exit;
			//assign
			//$this->_view->_assign('json', $json);
			//display
			//$this->_view->_display('index.tpl');
		} else {
			//这里做xml操作
			//echo 'this is xml';
		}
	}
}