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

//PR值常量，范围0-7
define('PAGE_RANK_ZONE',  0);
define('PAGE_RANK_ONE',   1);
define('PAGE_RANK_TWO',   2);
define('PAGE_RANK_THREE', 3);
define('PAGE_RANK_FOUR',  4);
define('PAGE_RANK_FIVE',  5);
define('PAGE_RANK_SIX',   6);
define('PAGE_RANK_SEVEN', 7);

class SpiderWeb
{
	private $_db = null;
	
	private $_rooturl = "";
	
	private $_bid = "";
	
	public function __construct()
	{
		ini_set('memory_limit','600M');
		$this->_db = new Mysql();
	}
	
	/**
	 * 获取网页内容
	 */
	public function getContents($url)
	{
		$ch  = curl_init();
		$timeout = 10;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);//输出头部信息
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//可以用来获取被重定向后的内容
		$contents = curl_exec($ch);
		$code     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error    = curl_error($ch);
		curl_close($ch);
		
		/*
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
		curl_setopt($ch, CURLOPT_HEADER,1);  
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //是否抓取跳转后的页面
		ob_start();  
		curl_exec($ch);  
		$contents = ob_get_contents();  
		ob_end_clean();  
		curl_close($ch);
		*/
		return $contents;
		
	}
	
	/**
	 * 获取一号店主分类网页中所有分类链接和分类名
	 */
	public function getLinkAndContent($html)
	{
		//preg_match_all("/<a.*?href=[\'\"](.*?)[\'\"][^>]*>/", $html, $data);
		preg_match_all("'<em.*?><span[^>]*?><a.*?href=[\'\"](.[^>]*?)[\'\"][^>]*?>(.[^<]*?)</a>\|?</span></em>'si", $html, $data);
		return $data;
	}
	
	/*
	 * 取得一号店具体分类价格
	 */
	public function getPrice($html)
	{
	  preg_match_all("/<li\sclass=\"producteg\"[^>]*?>.*?<strong[^>].*?>(.*?)<\/strong>.*?<\/li>/si", $html, $data);
	  foreach($data[1] as $key => $val) {
	  	$data[1][$key] = mb_substr($val, 1, 100, 'utf-8');
	  }
	  return $data[1];
	}
	
	/**
	 * 取得一号店具体分类产品名
	 *
	 */
	public function getTitle($html)
	{
		preg_match_all("/<li\sclass=\"producteg\"[^>]*?>.*?<img.*?title=[\'\"](.*?)[\'\"][^>]*>.*?<\/li>/si", $html, $data);
		return $data[1];
		//return $count;
	}
	
	/**
	 * 取得一号店具体分类产品描述
	 *
	 */
	public function getDes($html)
	{
		preg_match_all("/<li\sclass=\"producteg\"[^>]*?>.*?<a\sclass=\"title\".*?title=\"(.*?)\"[^>]*?>.*?<\/li>/si", $html, $data);
		return $data[1];
	}
	
	/**
	 * 取得一号店具体分类产品链接
	 *
	 */
	 public function getLinks($html)
	 {
 		preg_match_all("/<li\sclass=\"producteg\"[^>]*?>.*?<a\sclass=\"title\".*?href=\"(.*?)\"[^>]*?>.*?<\/li>/si", $html, $data);
 		return $data[1];
	 }

	/**
	 * 获得一号店具体分类的总页数
	 *
	 */
	public function getTotalPageCount($html)
	{
		//<span class="pageOp">共3页</span>
		preg_match_all("/<span\sclass=[\"|\']pageOp[\"|\']>[\W]*([0-9]+)*[\W]*<\/span>/si", $html, $data);
		if(count($data[0]) == 0) {
			$count = false;
		} else {
			$count = $data[1][0];	
		}
		return $count;
	}
	
	/**
	 * 获取具体分类页分页形式url
	 *
	 */
	public function getPageUrl($html)
	{
		//$str = '<a id="page_2" url="http://www.yihaodian.com/ctg/searchPage/c23586-%E6%89%8B%E6%9C%BA/b/a-s1-v0-p2-price-d0-f0-m1-rt0-pid-k/5/" href="http://www.yihaodian.com/ctg/s2/c23586-%E6%89%8B%E6%9C%BA/b/a-s1-v0-p2-price-d0-f0-m1-rt0-pid-k/5/" onClick="lazyLoad_AdHtmlData(1,2)">2</a>';
		//$str2 = '<a id="page_2" url="http://www.yihaodian.com/ctg/searchPage/c23586-%E6%89%8B%E6%9C%BA/b/a-s1-v0-p2-price-d0-f0-m1-rt0-pid-k/5/" href="http://www.yihaodian.com/ctg/s2/c23586-%E6%89%8B%E6%9C%BA/b/a-s1-v0-p2-price-d0-f0-m1-rt0-pid-k/5/" onClick="lazyLoad_AdHtmlData(1,2)">2</a>';
		preg_match_all("/<a\s+id=\"page_2\".*href=\"(.*?)\".*?>/", $html, $data);
		
		if(count($data[0]) == 0) {
			$url = false;
		} else {
			$url = $data[1][0];
		}
	
		return $url;
	}
	
	public function href($str)
	{
	 	$count = preg_match_all("'href'", $str, $out);
	 	return $count;	
	}
	
	public function setConf($rooturl, $bid)
	{
		$this->_rooturl = $rooturl;
		$this->_bid     = $bid;
	}
	
	/**
	 * 获得一号店主分类数据并入库
	 *
	 */
	public function InsertCategory()
	{
		$contents = $this->getContents($this->_rooturl);
		$datas = $this->getLinkAndContent($contents);
		
		$links   = $datas[1];
		$content = $datas[2];
		
		$category = array();
		for($i=0; $i<count($links); $i++) {
			$category[$i] = array(
							'name'        => $content[$i],
							'url'         => $links[$i],
							'bid'         => $this->_bid,//商务网站id
							'create_time' => 'UNIX_TIMESTAMP()',
			);
		}
		
		$this->_db->runMysql();
		$this->_db->setPrefix('ns');
		$this->_db->setNames('UTF8');
		$ret = array();
		foreach($category as $key => $val) {
			$ret[$key] = $this->_db->Insert('category', $val);
		}
		print_r($ret);
	}
	
	
	/**
	 * 获取主分类中的所有url信息，包括分类id,电子商务网站id
	 *
	 */
	private function getMasterUrlInfo()
	{
		$this->_db->runMysql();
		$this->_db->setPrefix('ns');
		$this->_db->setNames('UTF8');
		$result = $this->_db->Select('category');
		$urlinfo = array();
		foreach($result as $key => $val) {
			$urlinfo[] = array('cid'=>$val['id'], 'bid'=>$val['bid'], 'url'=>$val['url']);
		}
		return $urlinfo;
	}
	
	/**
	 * 获取所有分类商品具体页面的url包括分页的url
	 *
	 *
	 */
	private function getDetailPageUrl()
	{
		$urlinfo  = $this->getMasterUrlInfo();
		//$urlinfo = array(array('cid' => 1,'bid' => 1,'url' => 'http://www.yihaodian.com/ctg/s2/c23586-%E6%89%8B%E6%9C%BA/'),array('cid' => 2,'bid' => 1,'url' => 'http://www.yihaodian.com/ctg/s2/c21317-%E5%AF%B9%E8%AE%B2%E6%9C%BA/'));
		foreach($urlinfo as $key => $val) {
			$contents[$key]  = array('cid'=>$val['cid'], 'bid'=>$val['bid'], 'content'=>@file_get_contents($val['url']));
		}
		
		foreach($contents as $key => $val) {
			$count[$key] = $this->getTotalPageCount($val['content']);
			$url[$key]   = $this->getPageUrl($val['content']);
			$cids[$key]  = $val['cid'];
			$bids[$key]  = $val['bid'];
		}
		
		foreach($url as $key => $val) {
			if($val) {
				$urlprefix[$key] = strstr($val, 'p2', true);
				$urlend[$key]    = substr(strstr($val, 'p2'),2);
			} else {
				$onlyPage[$key]  = $urlinfo[$key]['url'];
			}
		}
		
		$urls = array();//具体分类中所有页面url,分页的url
		foreach($count as $key => $val) {
			if($val && $url[$key]) {
				for($i=1; $i<=$val; $i++) {
						$urls[] = array('cid'=>$cids[$key], 'bid'=>$bids[$key], 'url'=>$urlprefix[$key] . 'p' . $i . $urlend[$key]);
				}
			} else {
				$urls[] = array('cid'=>$cids[$key], 'bid'=>$bids[$key], 'url'=>$onlyPage[$key]);
			}
		}
		return $urls;
	}
	
	/**
	 * 获取具体分类页面的产品名称和价格并入库
	 *
	 *
	 */
	public function InsertProduct()
	{
		$urls = $this->getDetailPageUrl();
		//$urls = array(array('cid'=>1,'bid'=>1,'url'=>'http://www.yihaodian.com/ctg/s2/c23586-%E6%89%8B%E6%9C%BA/b/a-s1-v0-p1-price-d0-f0-m1-rt0-pid-k/1/'));
		$products = array();
		foreach($urls as $key => $val) {
			$products[$key] = array('cid'=>$val['cid'], 'bid'=>$val['bid'], 'title'=>$this->getTitle(@file_get_contents($val['url'])), 'des'=>$this->getDes(@file_get_contents($val['url'])), 'price'=>$this->getPrice(@file_get_contents($val['url'])), 'url'=>$this->getLinks(@file_get_contents($val['url'])));
		}
		
		$datas = array();
		foreach($products as $key => $val) {
			for($i=0; $i<count($val['title']); $i++) {
				$datas[] = array('cid'=>$val['cid'], 'bid'=>$val['bid'], 'title'=>$val['title'][$i], 'des' => $val['des'][$i], 'price'=>$val['price'][$i], 'url'=>$val['url'][$i], 'pr'=>0, 'create_time'=>'UNIX_TIMESTAMP()');
			}
		}

		$this->_db->runMysql();
		$this->_db->setPrefix('ns');
		$this->_db->setNames('UTF8');
		$ret = array();
		
		foreach($datas as $key => $val) {
			$ret[$key] = $this->_db->Insert('product', $val);
		}
		print_r($ret);
	}
}


/**
 * Spider内置数据库操作类
 *
 */
class Mysql
{
	private $host   = '127.0.0.1';
	private $mysql  = null;
	private $dbname = "ns";
	private $prefix = false;
	private $mysql_user = 'root';
	private $mysql_pwd	 = '123456';

	public function runMysql()
	{
		$dsn = "mysql:host=". $this->host .";dbname=" . $this->dbname;
		$this->mysql = new PDO($dsn,$this->mysql_user,$this->mysql_pwd);
	}
	
	public function setDbName($dbname)
	{
		$this->dbname = $dbname;
	}
	
	public function setHost($host)
	{
		$this->host = $host;
	}
	
	public function setMysqlUser($user)
	{
		$this->mysql_user = $user;
	}
	
	public function setMysqlPwd($pwd)
	{
		$this->mysql_pwd = $pwd;	
	}
	
	public function setPrefix($prefix)
	{
		$this->prefix = $prefix;
	}
	
	public function setNames($charset)
	{
		$this->mysql->exec("SET NAMES '" . $charset . "';");
	}
	
	public function Select($table, $where = "")
	{		
		if($this->prefix) {
			$table = $this->prefix . '_' . $table;
		}
		
		if($where != "") {
			$sql = "SELECT * FROM $table $where";	
		} else {
			$sql = "SELECT * FROM $table";	
		}
		
		$rs = $this->mysql->query($sql);
		$result = $rs->fetchAll();
		return $result;
	}
	
	public function Insert($table, $values=array())
	{		
		if($this->prefix) {
			$table = $this->prefix . '_' .$table;
		}
		
		if(count($values) == 0) {
			return 'param error';
		}
		foreach($values as $key => $val)
		{
				if(is_string($val) && $val != 'UNIX_TIMESTAMP()') {
						$values[$key] = "'" . $val . "'";
				}
		}
		
		$field = implode(',', array_keys($values));
		$value = implode(',', array_values($values));
		
		$sql = "INSERT INTO $table ($field) VALUES ($value)";
		$count = $this->mysql->exec($sql);
		return $count;
	}
}