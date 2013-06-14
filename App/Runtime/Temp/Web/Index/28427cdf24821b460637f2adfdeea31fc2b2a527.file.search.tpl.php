<?php /* Smarty version Smarty-3.1.6, created on 2013-06-14 17:54:48
         compiled from "D:\www\test\PHP\NS\App\Modules/Web/Tpl/Index\search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2437151bae5e4affd05-35233344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28427cdf24821b460637f2adfdeea31fc2b2a527' => 
    array (
      0 => 'D:\\www\\test\\PHP\\NS\\App\\Modules/Web/Tpl/Index\\search.tpl',
      1 => 1371203656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2437151bae5e4affd05-35233344',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_51bae5e4b9442',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51bae5e4b9442')) {function content_51bae5e4b9442($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../Common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body>
	<div class="searchbox clearfix">
        <a href="http://search.dxy.cn" class="fl ml15"><img src="http://assets.dxycdn.com/app/search/images/small_logo.png" alt="丁香搜索"></a>
        <div class="search fl clearfix" id="search-result-bar">
            <form method="get" action="http://search.dxy.cn" onsubmit="return searchutil.format();">
                <input type="text" name="q" class="pure-input-rounded" style="width:490px;height:22px;" autofocus="true" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" aria-haspopup="true" aria-combobox="list" role="combobox">
				<button type="submit" class="pure-button pure-button-primary" style="height:">Search</button>
            </form>
        </div>
        <div class="advance fl"><a href="http://search.dxy.cn?words=%26lt%3B%26gt%3B%26lt%3B%26gt%3B%26lt%3B%26gt%3B%26lt%3Bscript%26gt%3Balert%28%2Fx%2F%29%26lt%3B%2Fscript%26gt%3B&amp;action=Advanced">高级搜索</a></div>
		<div class="advance fl" style="padding-left:20px;">
			
		</div>
		 <p class="search-result-num">找到约280602条结果</p> 		
    </div>
</body><?php }} ?>