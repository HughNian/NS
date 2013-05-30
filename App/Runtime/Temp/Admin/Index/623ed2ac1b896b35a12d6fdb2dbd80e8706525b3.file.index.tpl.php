<?php /* Smarty version Smarty-3.1.6, created on 2013-05-30 16:55:12
         compiled from "D:\www\test\PHP\NS\App\Modules/Admin/Tpl/Index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:502251a70d8826d696-70734770%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '623ed2ac1b896b35a12d6fdb2dbd80e8706525b3' => 
    array (
      0 => 'D:\\www\\test\\PHP\\NS\\App\\Modules/Admin/Tpl/Index\\index.tpl',
      1 => 1369904110,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '502251a70d8826d696-70734770',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_51a70d882afd2',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a70d882afd2')) {function content_51a70d882afd2($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign in Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }
      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
    </style>
    <link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.bootcss.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <![endif]-->
    <script src="/js/jquery.min.js"></script>
    <script type="text/javascript">
	    function fleshVerify(){
			//重载验证码
			var timenow = new Date().getTime();
			$('#verifyImg').attr('src', '/Admin/Index/verify/'+timenow);
		}
	</script>
  </head>
  <body>
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level" placeholder="Email address">
        <input type="password" class="input-block-level" placeholder="Password">
        <input type="text" class="input-block-level" placeholder="验证码" style="width:100px;">
        <img id="verifyImg" src="/Admin/Index/verify" onClick="fleshVerify()" border="0" alt="点击刷新验证码" style="cursor:pointer;" align="absmiddle">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>
	<?php echo $_smarty_tpl->getSubTemplate ("../Common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div> <!-- /container -->
</body>
</html><?php }} ?>