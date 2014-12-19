<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理首页</title>
<link href="/timetravel/Admin/Public/Admin/css/default/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/timetravel/Admin/Public/static/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/timetravel/Admin/Public/Admin/js/layout.js"></script>
</head>

<body class="mainbody">
	<form id="form1" runat="server">
<?php echo hook('AdminIndex');?>
		<!--内容-->
		<div class="line10"></div>

		<!--/内容-->
	</form>
</body>
</html>