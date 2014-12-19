<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统登录 - OneDream管理平台</title>
<link href="/timetravel/Admin/Public/Admin/css/default/style.css" rel="stylesheet" type="text/css" />
<link href="/timetravel/Admin/Public/Admin/css/base.css" rel="stylesheet" type="text/css" />
</head>

<body class="loginbody">
		<div id="top-alert" class="fixed alert alert-error"
			style="display: none;">
			<button class="close fixed" style="margin-top: 4px;display:none;">&times;</button>
			<div class="alert-content">这是内容</div>
		</div>

	<form name="form1" method="post" action="<?php echo U('login');?>"
		class='loginform'>

		<div class="login-screen">
			<div class="login-form">
				<h1>系统登录 - OneDream管理平台</h1>
				<div class="control-group">
					<input name="username" type="text" value="" id="username"
						class="login-field" placeholder="用户名" title="用户名" /> <label
						class="login-field-icon user" for="username"></label>
				</div>
				<div class="control-group">
					<input name="password" type="password" id="password"
						class="login-field" placeholder="密码" title="密码" /> <label
						class="login-field-icon pwd" for="password"></label>
				</div>
				<div>
					<button class="btn-login ajax-post" id="submit" type="submit"
						target-form="loginform">登 录</button>
				</div>

			</div>
		</div>
	</form>
	<script type="text/javascript" src="/timetravel/Admin/Public/static/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/timetravel/Admin/Public/Admin/js/common.js"></script>
	<script type="text/javascript">
		$(function() {
			//检测IE
			if ('undefined' == typeof (document.body.style.maxHeight)) {
				window.location.href = '<?php echo U('ieupdate');?>';
			}
		});
	</script>
</body>
</html>