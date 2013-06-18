<?php
class ProductModel extends WebModel
{
	protected $trueTableName = 'ns_product';
	
	public function getSearchDatas($ids=array(), $keyword)
	{
		$datas     = array();
		$real_data = array();
		if(count($ids) != 0) {
			foreach($ids as $key => $id) {
				$datas[] = $this->where('id = ' . $id)->select(array('title','des','price'));//getField('title','des','price','url','create_time');
			}
			return $datas;
		} else {
			return false;
		}
	}
}