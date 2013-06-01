<?php
/**
 * API,url默认控制器
 * 
 */
class IndexAction extends ApiAction
{
	public function _initialize()
	{
		parent::_initialize();
		$this->_setViewName('Index');//设置smarty模板目录
	}
	
	//接口统一入口控制器,(解析请求数据),版本v1.0
	public function index()
	{
		//获取提交过来的全部请求数据
		$apidata      = $this->_param();
		$apistructure = array_slice($apidata, 0, 1);
		//要求接口参数必须以，列如/get.json?user_id=2&token=fksndflkds,这种路由方式传值
		$params       = $_SERVER['QUERY_STRING'];
		//初始化具体参数值
		$cmd = $opt = $data = null;
		
		//具体赋值请求参数值
		$apivalues = array_values($apistructure)[0];
		$cmd       = ucfirst(array_keys($apistructure)[0]);//方法名第一个字母大写
		$apitype   = Utility::getExtension($apivalues); 
		$opt       = strstr($apivalues, '.' . $apitype, true);
		
		unset($apistructure);
		
		$params_arr = Url2Array($params);  
		if(false == $params_arr) {
			//$this->__echoJson(RE_COMMON_INCORRECT_ARGS, '');//传入参数有无
			exit('Sorry, that page doesn’t exist!');
		}
		
		//检测api模型方法是否存在
		$api_model = $cmd . 'Model()';
		if(!class_exists($api_model)) {
			$this->__echoJson(RE_COMMON_UNKNOWN_CMD, '');
			return;
		}
		//实例化api模型类
		$model = new $api_model;
		
		//检测提交的opt是否可用，存在
		$methodVerify = array($model, $opt);
		if(!is_callable($methodVerify, true)) {
			$this->__echoJson(RE_COMMON_UNKNOWN_OPT, '');
			return;
		}
		
		//解析data部分
		
		
	}
}