<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" content="text/html" http-equiv="content-type" />
<title>OneDream管理平台</title>
<link href="/Admin/Public/Admin/css/default/style.css" rel="stylesheet" type="text/css">
</head>
<body class="indexbody">
	<div class=""
		style="left: 0px; top: 0px; visibility: hidden; position: absolute;">
		<table class="ui_border">
			<tbody>
				<tr>
					<td class="ui_lt"></td>
					<td class="ui_t"></td>
					<td class="ui_rt"></td>
				</tr>
				<tr>
					<td class="ui_l"></td>
					<td class="ui_c">
						<div class="ui_inner">
							<table class="ui_dialog">
								<tbody>
									<tr>
										<td colspan="2">
											<div class="ui_title_bar">
												<div style="cursor: move;" class="ui_title"
													unselectable="on"></div>
												<div class="ui_title_buttons">
													<a style="display: inline-block;" class="ui_min"
														href="javascript:void(0);" title="最小化"> <b
														class="ui_min_b"></b>
													</a> <a style="display: inline-block;" class="ui_max"
														href="javascript:void(0);" title="最大化"> <b
														class="ui_max_b"></b>
													</a> <a class="ui_res" href="javascript:void(0);" title="还原">
														<b class="ui_res_b"></b> <b class="ui_res_t"></b>
													</a> <a style="display: inline-block;" class="ui_close"
														href="javascript:void(0);" title="关闭(esc键)">×</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="display: none;" class="ui_icon"></td>
										<td style="width: auto; height: auto;" class="ui_main">
											<div style="padding: 10px;" class="ui_content"></div>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<div style="display: none;" class="ui_buttons"></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
					<td class="ui_r"></td>
				</tr>
				<tr>
					<td class="ui_lb"></td>
					<td class="ui_b"></td>
					<td style="cursor: se-resize;" class="ui_rb"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="header">
		<div class="header-box">
			<a class="item" target="mainframe" href="<?php echo U('admin/index/center');?>">
				<h1 class="logo"></h1>
			</a>
			<ul id="nav" class="nav">
			</ul>
			<div class="nav-right">
				<div class="icon-info">
					<span> 您好，<?php echo session('user_auth.nickname');?> </span>
				</div>
				<div class="icon-option">
					<i></i>
					<div class="drop-box">
						<div class="arrow"></div>
						<ul class="drop-item">
							<li><a target="_blank" href="<?php echo U('hone/index/index');?>">预览网站</a>
							</li>
							<li><a href="<?php echo U('admin/index/center');?>" target="mainframe">管理中心</a>
							</li>
							<li><a onclick="linkMenuTree(false, '');"
								href="<?php echo U('User/updatePassword');?>" target="mainframe">修改密码</a></li>
							<li><a id="lbtnExit" href="<?php echo U('Public/logout');?>">注销登录</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-sidebar">
		<div tabindex="5000" style="overflow: hidden;" id="sidebar-nav"
			class="sidebar-nav">
			<div class="list-box">
				<?php if(is_array($menu)): foreach($menu as $key=>$parent): ?><div class="list-group" name="<?php echo ($parent["title"]); ?>">
					<?php if(!empty($parent['_child'])): if(is_array($parent['_child'])): foreach($parent['_child'] as $key=>$child): ?><h2>
						<?php echo ($child["title"]); ?> <i></i>
					</h2>
					<?php if(!empty($child['_child'])): ?><ul>
					<?php if(is_array($child['_child'])): foreach($child['_child'] as $key=>$child2): ?><li><a navid="navid<?php echo ($child2["id"]); ?>" class="item" target="mainframe"
							href="<?php echo U($child2['url']);?>"> <span><?php echo ($child2["title"]); ?></span>
						</a></li><?php endforeach; endif; ?>
						
					</ul><?php endif; endforeach; endif; endif; ?>

				</div><?php endforeach; endif; ?>
			</div>
		</div>
	</div>
	<div class="main-container">
		<iframe id="mainframe" name="mainframe"
			src="<?php echo U('admin/index/center');?>" frameborder="0"></iframe>
	</div>
	<script type="text/javascript" src="/Admin/Public/static/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/Admin/Public/static/jquery.nicescroll.js"></script>
	<script type="text/javascript" src="/Admin/Public/Admin/js/layout.js"></script>
	<script type="text/javascript" src="/Admin/Public/Admin/js/index.js"></script>
</body>
</html>