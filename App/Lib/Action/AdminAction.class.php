<?php
class AdminAction extends CommonAction
{
	public function _initialize()
	{
		//检查认证识别号
		if ( 'public' != strtolower(MODULE_NAME)) {
			if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
				redirect(__GROUP__.'/Public/login');
			}
		}
	}
	
	
}