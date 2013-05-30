<?php
/**
 * Admin后台登录
 * 
 * @author HughNian
 *
 */
class IndexAction extends AdminAction
{
	public function _initialize()
	{
		$this->_setViewName('Index');
	}
	
    public function index() 
    {
    	
        $this->_view->_display('index.tpl');
    }
    
    //验证码
    public function verify()
    {
    	$type = isset($_GET['type'])?$_GET['type']:'gif';
    	ImageGd::GBVerify();
    }
}