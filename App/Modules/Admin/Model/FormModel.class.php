<?php
class FormModel extends AdminModel 
{
    // 自动验证设置
    protected $_validate	 =	 array(
        array('title','require','标题必须！',1),
        array('content','require','内容必须'),
        array('title','','标题已经存在',0,'unique',self::MODEL_INSERT),
        );
    
    // 自动填充设置
    protected $_auto	 =	 array(
        array('status','1',self::MODEL_INSERT),
        array('create_time','time',self::MODEL_INSERT,'function'),
        );
    
    public function getList($count=5)
    {
    	return $this->order('id DESC')->field(true)->limit($count)->select();
    }
    
    public function getDetail($id=0)
    {
    	return $this->field(true)->find($id);
    }
    
    public function getdata($status, $count)
    {
    	return $this->where(sprintf('status = %d', $status))
    	->order('id DESC')
    	->limit($count)
    	->select();
    }
}