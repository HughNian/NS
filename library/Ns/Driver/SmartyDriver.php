<?php
defined('NS_PATH') or exit();
/**
 * Smarty模板引擎驱动 
 *
 */
class SmartyDriver
{
	protected $_view = null;
	protected $_viewName;
	
	/**
	 * 初始化Smarty
	 * 
	 */
	public function __construct($viewName)
	{
		$this->setViewName($viewName);
		
		ns_import('Smarty.Smarty', NS_PATH . 'Vendor');
		
		$glist  = explode(',', C('APP_GROUP_LIST'));
		foreach($glist as $val) {
			if(strpos(THEME_PATH, $val)) {
				$module = $val;
				break;
			}
		}
		
		$this->_view = new Smarty();
		
		$this->_view->error_reporting = E_ALL & ~E_NOTICE;
		//指定默认的delimiter
		$this->_view->left_delimiter  = '<!--{';
		$this->_view->right_delimiter = '}-->';
		
		$this->_view->caching         = C('TMPL_CACHE_ON');
		$this->_view->template_dir    = THEME_PATH . $this->_viewName;
		$this->_view->compile_dir     = TEMP_PATH  . $module . DIRECTORY_SEPARATOR . $this->_viewName;
		$this->_view->cache_dir       = CACHE_PATH . $module . DIRECTORY_SEPARATOR . $this->_viewName;
		if(C('TMPL_ENGINE_CONFIG')) {
			$config  =  C('TMPL_ENGINE_CONFIG');
			foreach ($config as $key=>$val){
				$this->_view->{$key}   =  $val;
			}
		}
	}
	
    /**
     * 渲染模板输出
     * @access public
     * @param string $templateFile 模板文件名
     * @param array $var 模板变量
     * @return void
     */
    public function Sfetch($templateFile,$var)
    {
        $templateFile = substr($templateFile,strlen(THEME_PATH));
        $this->_view->assign($var);
        $this->_view->display($templateFile);
    }
    
    /**
     * 重写smarty display()方法
     * 
     * @param string $template -模板名
     */
    public function _display($template)
    {
    	$this->_view->display($template);
    }
    
    /**
     * 重写smarty assign()方法
     * 
     */
    public function _assign($tvar, $var)
    {
    	$this->_view->assign($tvar, $var);
    }
    
    /**
     * 设置模板目录名
     * 
     * @param unknown $viewName
     */
    private function setViewName($viewName)
    {
    	if(!isset($viewName)) {
    		$this->_viewName = 'index';
    	} else {
    		$this->_viewName = $viewName;
    	}
    }
}