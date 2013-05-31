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