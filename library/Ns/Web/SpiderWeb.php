<?php
/**
 * PHP搜索引擎蜘蛛类(2013-06-06)
 * 
 * @version 1.0.0
 * 
 * @author hughnian
 * 
 * @package NS.Web
 * 
 * 功能：抓取网页，实现快照，并根据网页中链接抓取相应链接网页，同时根据网页一些特性对网页快照进行权重赋值
 * 
 */

//PR值常量，范围1-7
define('PAGE_RANK_ONE',   1);
define('PAGE_RANK_TWO',   2);
define('PAGE_RANK_THREE', 3);
define('PAGE_RANK_FOUR',  4);
define('PAGE_RANK_FIVE',  5);
define('PAGE_RANK_SIX',   6);
define('PAGE_RANK_SEVEN', 7);

class SpiderWeb
{
	private $links = "";
	
	private $timeout = 300;
	
	private $db_button = 'off';
	
	public function __construct()
	{
		if($this->links == "") {
			throw new Exception("links must be defined");
		}
	}
	
	/**
	 * 提交所要爬行的网址
	 * 
	 * @param mix $links
	 */
	public function SetLinks($links)
	{
		$this->links = $links;
	}
	
	/**
	 * 设置蜘蛛程序结束时间
	 * 
	 */
	public function SetTimeOut($time)
	{
		$this->timeout = $time;
	}
	
	/**
	 * 是否开启本类自带操作数据库功能，默认关闭，采用框架操作数据库,
	 * 开启则脱离框架采用本类操作数据库功能，一般用于在服务器端运行.
	 * 
	 */
	public function DbButton($var)
	{
		$this->db_button = $var;
	}
	
	/**
	 * 分析html
	 * 
	 */
	private function AnalysisHtml()
	{
		
		
	}
	
	
	/**
	 * 解析html
	 * 
	 */
	private function ExtractHtml()
	{
		
		
	}
	
	/**
	 * 数据库操作方法
	 * 
	 */
	private function DbHandle()
	{
		if() {
			
		}
		
	}
	
	
}