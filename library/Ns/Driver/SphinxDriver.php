<?php
defined('NS_PATH') or exit();
/**
 * Sphinx搜索引擎驱动
 * 
 */
ns_import('Sphinx.Sphinxapi', NS_PATH . 'Vendor', '.php');//引入sphinx,php接口

class SphinxDriver extends SphinxClient
{
	public function __construct()
	{
		
	}
	
	/**
	 * 重写SetServer方法在程序中可以使用 
	 *
	 */
	public function _SetServer($host, $port = 0)
	{
		$this->SetServer($host, $port);
	}
	
	/**
	 * 重写SetConnectTimeout方法在程序中可以使用 
	 * 
	 */
	public function _SetConnectTimeout($timeout)
	{
		$this->SetConnectTimeout($timeout);
	}
	
	
}