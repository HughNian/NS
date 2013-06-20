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
    	$url     = C('API_SEARCH_URL');
    	$crypt   = new TripleDesCrypt(C('API_KEY'), C('API_IV'), false);
    	$sphinx  = new SphinxDriver();
    	$keyword_model = new KeyWordsModel();
    	
    	$keyword = InputWeb::safeHtml($this->_param('q'));
    	$keyword = InputWeb::deleteHtmlTags($keyword);
    	$keyword = trim($keyword);
    	$keyword = Utility::h($keyword);
    	$page    = $this->_param('pn');
    	$offset  = $page == "" ? 0 : ($page-1)*10;
    	$limit   = 10;
    	
    	/***搜索需要的参数值形式
    	$crypt  = new TripleDesCrypt(C('API_KEY'), C('API_IV'), false);
    	$array  = array('internal' => array('query' => 'iphone'));
    	$data   = $crypt->encrypt(json_encode($array));
    	echo urlencode($data); //用NS套框架HTTP请求方法时不要用urlencode,HTTP请求方法已经用http_build_query自动实现了urlencode
    	***/
    	
    	if($keyword == "") {
    		$this->redirect('/');
    	} else if(ceil(strlen($keyword)/3) > 38) {
    		$this->error('Content of the input more than limit', '/');
    	}
    	
    	/**处理keyword**/
    	if($page == "") {
    		$ret = $keyword_model->addKeyWord($keyword);
    	}
    	
    	//KIb6skTwg6KHpPdtrNthjrAdT1yIXd0brbRAnWS9ZVC0g11YvC6nbgq61wpeGCEjlFB6CPX7dD0%3D,keyword:iphone;
    	//内部发送http请求接口
    	$internal = $crypt->encrypt(json_encode(array('internal' => array('query'=>$keyword, 'offset'=>$offset, 'limit'=>$limit))));
    	$params   = array('p' => $internal);
    	$ret      = HttpRequestNet::request($url, $params);
    	$ret      = json_decode($ret);
    	$datas    = json_decode($crypt->decrypt($ret->data), true);
    	
    	//if(count($datas['internal']) == 0)  $this->error('Sphinx Server Does not Open!', '/');
    	
    	$totalnum    = $datas['internal']['total'];
    	$total_found = $datas['internal']['total_found'];
    	$this->_view->_assign('totalnum', $totalnum);
    	$this->_view->_assign('total_found', $total_found);
    	
    	//分页
    	$pagination = $this->Page($totalnum, 10, "q=$keyword", 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PATH_INFO'] . "?");
    	
    	unset($datas['internal']['total']);
    	unset($datas['internal']['total_found']);
    	$real_datas  = $datas['internal'];
    	
    	//相关搜索
    	$likekeyword  = $keyword_model->getLikeKeyword($keyword);
    	$likekeyword  = array_slice($likekeyword, 0, 10);
    	
    	$this->_view->_assign('keyword', $keyword);
    	$this->_view->_assign('real_datas', $real_datas);
    	$this->_view->_assign('pagination', $pagination);
    	$this->_view->_assign('likekeyword', $likekeyword);
    	$this->_view->_assign('title', C('WEB_TITLE'));
    	$this->_view->_display('search.tpl');
    }
}