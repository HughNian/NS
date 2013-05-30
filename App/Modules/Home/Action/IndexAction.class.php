<?php
class IndexAction extends HomeAction
{	
	public function _initialize()
	{
		$this->_setViewName('Index');
	}
	
    public function index()
    {
        $Model  =   D('Form');
        $data = $Model->getList();
        $hello = 'hello woeld this is tpl,hello ns framework 这是';
        $this->_view->_assign('hello', $hello);
        $this->_view->_display('test.tpl');
    }

    public function read($id=0)
    {
        $Model  =   D('Form');
        $this->assign('vo',$Model->getDetail($id));
        $this->display();
    }
}