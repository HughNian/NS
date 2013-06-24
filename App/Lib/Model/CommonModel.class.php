<?php
class CommonModel extends Model
{
	protected $_memcached = null;
	
	public function __constrcut()
	{
		parent::__construct();
		$this->_memcached = new CacheMemcache(array('host'=>C('MEMCACHED_HOST'), 'port'=>C('MEMCACHED_PORT'), 'timeout'=>C('DATA_CACHE_TIME')));
	}
	
	// 获取当前用户的ID
    public function getMemberId()
    {
        return isset($_SESSION[C('USER_AUTH_KEY')])?$_SESSION[C('USER_AUTH_KEY')]:0;
    }

   /**
     +----------------------------------------------------------
     * 根据条件禁用表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function forbid($options,$field='status')
    {

        if(FALSE === $this->where($options)->setField($field,0)) {
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        } else {
            return True;
        }
    }

	 /**
     +----------------------------------------------------------
     * 根据条件批准表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */

    public function checkPass($options,$field='status')
    {
        if(FALSE === $this->where($options)->setField($field,1)) {
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        } else {
            return True;
        }
    }


    /**
     +----------------------------------------------------------
     * 根据条件恢复表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function resume($options,$field='status')
    {
        if(FALSE === $this->where($options)->setField($field,1)) {
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        } else {
            return True;
        }
    }

    /**
     +----------------------------------------------------------
     * 根据条件恢复表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function recycle($options,$field='status')
    {
        if(FALSE === $this->where($options)->setField($field,0)) {
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        } else {
            return True;
        }
    }
}