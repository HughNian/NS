<?php /* Smarty version Smarty-3.1.6, created on 2013-06-27 10:18:14
         compiled from "D:\www\test\PHP\NS\App\Modules/Web/Tpl/Index\search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2437151bae5e4affd05-35233344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28427cdf24821b460637f2adfdeea31fc2b2a527' => 
    array (
      0 => 'D:\\www\\test\\PHP\\NS\\App\\Modules/Web/Tpl/Index\\search.tpl',
      1 => 1372299081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2437151bae5e4affd05-35233344',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_51bae5e4b9442',
  'variables' => 
  array (
    'keyword' => 0,
    'totalnum' => 0,
    'total_found' => 0,
    'real_datas' => 0,
    'val' => 0,
    'pagination' => 0,
    'likekeyword' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51bae5e4b9442')) {function content_51bae5e4b9442($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:\\www\\test\\PHP\\NS\\library\\Ns\\Vendor\\Smarty\\plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\www\\test\\PHP\\NS\\library\\Ns\\Vendor\\Smarty\\plugins\\modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("../Common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style type="text/css">
	h1 {font-weight:100; margin-top:0px;}
	a:hover {text-decoration:none;}
</style>
<body>
<div class="header pure-u-1" style="margin-bottom:25px;">
        <div class="pure-menu pure-menu-open pure-menu-fixed pure-menu-horizontal" style="background:#333;">
            <a class="pure-menu-heading" href="">Seek About</a>
            <ul>
                <li><a href="#">Search</a></li>
                <li><a href="#">Tour</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>
</div>
<div id="wrapper">
	<!----{顶部搜索框}---->
	<div class="searchbox clearfix" style="width:100%;">
        <a href="/" class="fl ml15"><h1><font color="#6E329D">Seek About</font></h1></a>
        <div class="search fl " id="search-result-bar">
            <form method="get" action="/index/search" onsubmit="return searchutil.format();">
                <input type="text" name="q" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" class="pure-input-rounded" style="float:left;width:490px;height:25px;" autofocus="true" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" aria-haspopup="true" aria-combobox="list" role="combobox">
				<button type="submit" class="pure-button pure-button-primary" style="float:left;height:35px;margin-left:5px;">Search</button>
            </form>
        </div>
		<div class="advance fl" style="padding-left:20px;"></div>
		 <?php if ($_smarty_tpl->tpl_vars['totalnum']->value!=0){?><p class="search-result-num">找到约<?php echo $_smarty_tpl->tpl_vars['total_found']->value;?>
条结果</p><?php }?>
    </div>
    
    <!---{搜索结果}---->
    <div class="clearfix" id="result">
        <div class="fl" id="main" style="float:left;margin-left:-45px;">
        	<?php if ($_smarty_tpl->tpl_vars['totalnum']->value!=0){?>
            <dl>
                <dd id="zhaiyao">
	                	<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['real_datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
							<ul>
		                        <li><a class="title pic" href="<?php echo $_smarty_tpl->tpl_vars['val']->value['url'][0];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'][0];?>
</a></li>
		                        <li class="content">
									<?php echo $_smarty_tpl->tpl_vars['val']->value['des'][0];?>

								</li>
		                        <li class="author">
		                        	<span><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['val']->value['url'][0],75,'....',true);?>
 发表于 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_time'][0],"%Y-%m-%d %H:%M:%S");?>
</span>
		                            <span id="score">价格:<?php echo $_smarty_tpl->tpl_vars['val']->value['price'][0];?>
</span>
		                        </li>
		                    </ul>
		                <?php } ?>
				 </dd>
            </dl>
            <div class="pure-paginator" style="float:left;margin-left:70px;">
				<?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

			</div>
		    <?php }else{ ?>
			    <dd id="zhaiyao">
			    	<ul>
		           		<li><h2>Sorry，Not Found Any Content About this <font color="#D50000"><?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
</font> Keyword.</h2></li>
		           	</ul>
		        </dd>
	        <?php }?>
        </div>
        
        <!---{右侧广告显示}--->
        <div class="fl w252" id="search_result">
        	<div class="adv200x150">
				<ul>
					<li></li>
				</ul>
			</div>
			<dl class="right_search" style="display:block;">
				<dt class="clearfix"><span class="fl">advertising promotion</span><span class="fr"><a target="_blank" href="http://search.jobmd.cn/">More</a></span></dt>
                <dd>
                    <dl id="oth_search_jobmd">
                    </dl>
                </dd>
                <dd class="line"></dd>
            </dl>
            <dl class="right_search" style="display:block;margin-top:10px;">
                <dt class="clearfix"><span class="fl">品牌推广</span><span class="fr"><a target="_blank" href="http://www.biomart.cn/product/heihei">More</a></span></dt>
                <dd>
                    <dl id="oth_search_tong">
                    </dl>
                </dd>
                <dd class="line"></dd>
            </dl>
       </div>
    </div>
    
    <!----{相关搜索结果}---->
    <div class="clearfix" id="relate" style="width:100%; float:left;margin-left:-160px;">
    	<div class="field fl" style="float:left;">相关搜索：</div>
        <div class="fl relatec" id="relatec" style="float:left;">
        	<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['likekeyword']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
        		<?php if ($_smarty_tpl->tpl_vars['key']->value==4){?>
        			<span><a href="/index/search/?q=<?php echo $_smarty_tpl->tpl_vars['val']->value['keyword'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['keyword'];?>
</a></span><br />
        		<?php }else{ ?>
        			<span><a href="/index/search/?q=<?php echo $_smarty_tpl->tpl_vars['val']->value['keyword'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['keyword'];?>
</a></span>
        		<?php }?>
        	<?php } ?>
        </div>
    </div>
    
    <!----{底部搜索框}---->
    <div class="searchbox-foot" style="width:100%; float:left; margin-left:25px;">
		<form method="get" action="/index/search" onsubmit="return searchutil.format();">
            <input type="text" name="q" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" class="pure-input-rounded" style="float:left;width:490px;height:25px;" autofocus="true" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" aria-haspopup="true" aria-combobox="list" role="combobox">
			<button type="submit" class="pure-button pure-button-primary" style="float:left;height:35px;margin-left:5px;">Search</button>
        </form>
    </div>
    
    <!---{底部版权信息}---->
    <div style="float:left; margin-left:25px; margin-top:10px;">&copy;niansong-2013, this is a sphinx test demo website, thank you for use it</div>
</div>
</body><?php }} ?>