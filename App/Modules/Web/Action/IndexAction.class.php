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
    	/***搜索需要的参数值形式
    	$crypt  = new TripleDesCrypt(C('API_KEY'), C('API_IV'), false);
    	$array  = array('internal' => array('query' => 'niansong'));
    	$data   = $crypt->encrypt(json_encode($array));
    	echo urlencode($data);
    	exit;
    	***/
    	$title  = C('WEB_TITLE');
        $this->_view->_assign('title', $title);
        $this->_view->_display('index.tpl');
    }
	
    /**
     * 搜索控制器
     * 
     */
    public function search()
    {
    	$url   = C('API_SEARCH_URL');
    	$keyword = InputWeb::safeHtml($this->_param('q'));
    	$keyword = InputWeb::deleteHtmlTags($keyword);
    	$keyword = trim($keyword);
    	$pn      = $this->_param('pn');
    	
    	if($keyword == "") {
    		$this->redirect('/');
    	} else if(ceil(strlen($keyword)/3) > 38) {
    		$this->error('Content of the input more than limit', '/');
    	}
    	
    	$this->_view->_display('search.tpl');
    }
}