<?php
/**
 * 3des加解密操作类
 * @author -
 *
 */
class TripleDesCrypt
{
    private $key = null;
    private $iv = null;
    
    public function __construct($key, $iv = '0102030405060708', $pack=true)
    {
    	$this->setKey($key, $pack);
    	$this->setIv($iv, $pack);
    }
    
    public function setIv($iv, $pack=true)
    {
        if (is_null($iv) || empty($iv)) {
            $iv = '0102030405060708';
        }
        if ($pack) $this->iv = pack('H16', $iv); else $this->iv = substr($iv, 0, 8);
    }
    
    public function setKey($key, $pack=true)
    {
        if (is_null($key) || empty($key)) {
            throw new Exception('Key expected but null given!', 0x01);
        }
        if ($pack) $this->key = pack('H32', $key); else $this->key = substr($key, 0, 24);
    }
    
    //加密
    public function encrypt($data)
    {
        $data = $this->padding($data);
        $td = mcrypt_module_open( MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
        //使用MCRYPT_3DES算法,cbc模式
        mcrypt_generic_init($td, $this->key, $this->iv);
        //初始处理
        $data = mcrypt_generic($td, $data);
        //加密
        mcrypt_generic_deinit($td);
        //结束
        mcrypt_module_close($td);
        $data = $this->removeBR(base64_encode($data));
        return $data;
    }
    
    //解密
    public function decrypt($data)
    {
        $data = base64_decode($data);
        $td = mcrypt_module_open( MCRYPT_3DES,'',MCRYPT_MODE_CBC,'');
        //使用MCRYPT_3DES算法,cbc模式
        mcrypt_generic_init($td, $this->key, $this->iv);
        //初始处理
        $decrypted = mdecrypt_generic($td, $data);
        //解密
        mcrypt_generic_deinit($td);
        //结束
        mcrypt_module_close($td);
        $decrypted = $this->removePadding($decrypted);
        return $decrypted;
    }
    
    //填充密码，填充至8的倍数
    public function padding($data)
    {
        $block_size = mcrypt_get_block_size('tripledes', 'cbc');
        $padding_char = $block_size - (strlen($data) % $block_size);
        $data .= str_repeat(chr($padding_char),$padding_char);
        return $data;
    }
    
    //删除填充符
    public function removePadding($str)
    {
        return substr($str, 0, strlen($str)-ord(substr($str,-1,1)));
    }
    
    //删除回车和换行
    public function removeBR($str) 
    {
        return preg_replace("/[\r\n]/", "", $str);
    }

}
