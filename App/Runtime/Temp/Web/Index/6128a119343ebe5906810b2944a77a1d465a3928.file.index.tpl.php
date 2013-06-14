<?php /* Smarty version Smarty-3.1.6, created on 2013-06-14 16:19:00
         compiled from "D:\www\test\PHP\NS\App\Modules/Web/Tpl/Index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2430351a6f0edf2be57-15964562%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6128a119343ebe5906810b2944a77a1d465a3928' => 
    array (
      0 => 'D:\\www\\test\\PHP\\NS\\App\\Modules/Web/Tpl/Index\\index.tpl',
      1 => 1371197719,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2430351a6f0edf2be57-15964562',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_51a6f0ee1ba84',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a6f0ee1ba84')) {function content_51a6f0ee1ba84($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../Common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style type="text/css">
	body {font-family: Consolas, 'Liberation Mono', Courier, monospace;}
</style>
<body>
    <div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" style="background:#FFF;">
        <div style="width:100%; height:100px;"></div>
        <center><h1><font color="#6E329D">Welcome NS</font></h1></center>
      	<center>
	      	<form method="POST" action="/index/search" class="form-search" style="margin-top:30px;">
			  <input type="text" name="q" class="pure-input-rounded" style="width:490px;height:30px;" autofocus="true" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" aria-haspopup="true" aria-combobox="list" role="combobox">
			  <button type="submit" class="pure-button pure-button-primary">Search</button>
			</form>
      	</center>
      </div>
      <!-- Example row of columns -->
      <div class="row">
        
      </div>
	<?php echo $_smarty_tpl->getSubTemplate ("../Common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdnjs.bootcss.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.bootcss.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
</body><?php }} ?>