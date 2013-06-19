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
    	
    	$keyword = InputWeb::safeHtml($this->_param('q'));
    	$keyword = InputWeb::deleteHtmlTags($keyword);
    	$keyword = trim($keyword);
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
    	$keyword_model = new KeyWordsModel();
    	$ret = $keyword_model->addKeyWord($keyword);
    	
    	//KIb6skTwg6KHpPdtrNthjrAdT1yIXd0brbRAnWS9ZVC0g11YvC6nbgq61wpeGCEjlFB6CPX7dD0%3D,keyword:iphone;
    	//内部发送http请求接口
    	$internal = $crypt->encrypt(json_encode(array('internal' => array('query'=>$keyword, 'offset'=>$offset, 'limit'=>$limit))));
    	$params   = array('p' => $internal);
    	$ret      = HttpRequestNet::request($url, $params);
    	$ret      = json_decode($ret);
    	$datas    = json_decode($crypt->decrypt($ret->data), true);
    	
    	//if(count($datas['internal']) == 0)  $this->error('Sphinx Server Does not Open!', '/');
    	
    	$totalnum = $datas['internal']['total'];
    	$this->_view->_assign('totalnum', $totalnum);
    	unset($datas['internal']['total']);
    	$real_datas = $datas['internal'];
    	
    	//分页
    	$Page = new PageWeb($totalnum, 10, "q=$keyword");
    	$Page->setConfig('header', '');
    	$Page->setConfig('last', '');
    	$Page->setConfig('theme', '%upPage% %downPage% %first%  %prePage%  %linkPage%  %nextPage% %end%');
    	$Page->setRollPage(10);
    	$Page->setUrl('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PATH_INFO'] . "?");
    	$pagination = $Page->show(); 
    	
    	$this->_view->_assign('keyword', $keyword);
    	$this->_view->_assign('real_datas', $real_datas);
    	$this->_view->_assign('pagination', $pagination);
    	$this->_view->_display('search.tpl');
    }
}