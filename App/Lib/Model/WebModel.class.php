<?php
class WebModel extends CommonModel
{
	public function __construct()
	{
		parent::__constrcut();	
	}
	
	public function runSphinx()
	{
		$sphinx = new SphinxDriver();
		$sphinx->D_SetServer (C('SPHINX_IP'), C('SPHINX_PORT'));
		$sphinx->D_SetConnectTimeout ( 3 );
		$sphinx->D_SetArrayResult ( true );
		$sphinx->D_SetMatchMode (SPH_MATCH_ALL);
		$sphinx->D_SetLimits (0, 10);
		
		return $sphinx;
	}
}