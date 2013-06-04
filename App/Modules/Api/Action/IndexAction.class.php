<?php
/**
 * API,url默认控制器
 * 
 */
class IndexAction extends ApiAction
{
	private $_crypt = null;
	public function _initialize()
	{
		parent::_initialize();
		$this->_setViewName('Index');//设置smarty模板目录
		$this->_crypt = new TripleDesCrypt(C('API_KEY'), C('API_IV'),false);
	}
	
	//接口统一入口控制器,(解析请求数据),版本v1.0
	//规定api、url路由规则为 ,例如http://www.ns.com/api/content/get.json?p=FK9KH88KQwQAGEp2FI%2BHzoHfUOvKeX9h,加密数据需要urlencode()后传到url上
	public function index()
	{
		//初始化具体参数值
		$cmd = $opt = $data = null;
		
		//获取提交过来的全部请求数据
		$apidata      = $this->_param();
		$apistructure = array_slice($apidata, 0, 1);
		//要求接口参数必须以，列如/get.json?user_id=2&user_type=3,这种路由方式传值
		$params       = $this->_param('p');//substr(strstr($_SERVER['QUERY_STRING'], '='),1);
		$data         = json_decode($this->_crypt->decrypt($params), true);//具体请求参数值,被加密的数据，需要先解密
		
		//具体赋值请求参数值
		$apivalues = array_values($apistructure)[0];
		$cmd       = ucfirst(array_keys($apistructure)[0]);//方法名第一个字母大写
		$apitype   = Utility::getExtension($apivalues);    //返回数据类型，json/xml，目前只支持json
		$opt       = strstr($apivalues, '.' . $apitype, true);
		if(!empty($apitype)) C('API_TYPE', $apitype);//通过url得知需要返回数据的类型，此处重新给配置文件赋值
		unset($apistructure);
		/*
		$params_arr = Url2Array($params);  
		if(false == $params_arr) {
			//$this->__echoJson(RE_COMMON_INCORRECT_ARGS, '');//传入参数有无效
			exit('Sorry, that page doesn’t exist!');
		}
		*/
		if($cmd == 'Search') $opt = 'get';
		//检测api模型方法是否存在
		$api_model = $cmd . 'Model';

		if(!class_exists($api_model)) {
			$this->__echoRet(RE_COMMON_UNKNOWN_CMD, '');
			return;
		}
		//实例化api模型类
		$model = new $api_model;
		
		//检测提交的opt是否可用，存在
		$methodVerify = array($model, $opt);
		if(!is_callable($methodVerify, true)) {
			$this->__echoRet(RE_COMMON_UNKNOWN_OPT, '');
			return;
		}
		
		//处理请求，返回结果
		$internal = $data['internal'];
		$result   = $model->$opt($internal);
		$this->__echoRet($result->result, $result->data);
	}
}