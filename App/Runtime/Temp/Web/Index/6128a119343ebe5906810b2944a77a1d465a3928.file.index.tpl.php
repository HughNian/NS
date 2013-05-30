<?php /* Smarty version Smarty-3.1.6, created on 2013-05-30 16:23:40
         compiled from "D:\www\test\PHP\NS\App\Modules/Web/Tpl/Index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2430351a6f0edf2be57-15964562%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6128a119343ebe5906810b2944a77a1d465a3928' => 
    array (
      0 => 'D:\\www\\test\\PHP\\NS\\App\\Modules/Web/Tpl/Index\\index.tpl',
      1 => 1369902216,
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

<body>
    <div class="navbar navbar-inverse navbar-fixed-top" style="height:20px;">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="/">Welcome NS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Content</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" style="background:#FFF;">
        <div style="width:100%; height:80px;"></div>
        <center><h1>Welcome NS</h1></center>
      	<center>
	      	<form class="form-search" style="margin-top:30px;">
			  <input type="text" class="input-medium search-query" style="width:490px;height:30px;">
			  <button type="submit" class="btn btn-large btn-primary">Search</button>
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