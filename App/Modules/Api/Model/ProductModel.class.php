<?php
class ProductModel extends WebModel
{
	protected $trueTableName = 'ns_product';
	
	public function getSearchDatas($ids=array())
	{
		$datas     = array();
		$real_data = array();
		if(count($ids) != 0) {
			foreach($ids as $key => $id) {
				$datas[] = $this->where('id = ' . $id)->select();
			}
			//echo $this->getLastSql();exit;
			return $datas;
		} else {
			return false;
		}
	}
}