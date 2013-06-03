<?php
class IndexAction extends WebAction
{	
	public function _initialize()
	{
		parent::_initialize();
		$this->_setViewName('Index');//设置smarty模板目录
	}
	
    public function index()
    {
    	$crypt = new TripleDesCrypt(C('API_KEY'), C('API_IV'));
    	$array = json_encode(array('1','2','3','4'));
    	$data = $crypt->encrypt($array);
    	echo $data.'<br />';
    	$json = $crypt->decrypt($data);
    	echo $json;
    	exit;
    	$title = C('WEB_TITLE');
        $this->_view->_assign('title', $title);
        $this->_view->_display('index.tpl');
    }
	
    public function read($id=0)
    {
        $Model  =   D('Form');
        $this->assign('vo',$Model->getDetail($id));
        $this->display();
    }
}