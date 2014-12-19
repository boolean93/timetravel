<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" content="text/html" http-equiv="content-type" />
<title>OneDream管理平台</title>
<script type="text/javascript" src="/timetravel/Admin/Public/static/jquery-1.10.2.min.js"></script>
<link href="/timetravel/Admin/Public/Admin/css/default/style.css" rel="stylesheet" type="text/css">
<link href="/timetravel/Admin/Public/static/bootstrap2/css/bootstrap.min.css" rel="stylesheet"
	type="text/css">
<link href="/timetravel/Admin/Public/static/bootstrap2/css/bootstrap-responsive.min.css"
	rel="stylesheet" type="text/css">
	
</head>

<body>
	<div class="container-fuild">
            <div id="top-alert" class="fixed alert alert-error"
            style="display: none;">
            <button class="close fixed" style="margin-top: 4px;display:none;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
		
<ul class="breadcrumb">
	<li><a href="javascript:history.back(-1)">返回上一页</a> <span
		class="divider">/</span></li>
	<li class="active"><?php echo ($meta_title); ?></li>
	<li><a class="btn btn-link" href="<?php echo U('addhook');?>">创建插件</a></li>
</ul>

<table class="table table-hover table-striped table-bordered">
	<thead>
		<tr>
			<th>名称</th>
			<th>标识</th>
			<th>描述</th>
			<th width="43px">状态</th>
			<th>作者</th>
			<th width="43px">版本</th>
			<th width="94px">操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($vo["title"]); ?></td>
			<td><?php echo ($vo["name"]); ?></td>
			<td><?php echo ($vo["description"]); ?></td>
			<td><?php echo ((isset($vo["status_text"]) && ($vo["status_text"] !== ""))?($vo["status_text"]):"未安装"); ?></td>
			<td><a target="_blank"
				href="<?php echo ((isset($vo["url"]) && ($vo["url"] !== ""))?($vo["url"]):'http://tox.ourstu.com/'); ?>"><?php echo ($vo["author"]); ?></a></td>
			<td><?php echo ($vo["version"]); ?></td>
			<td>
						<?php if(empty($vo["uninstall"])): $class = get_addon_class($vo['name']); if(!class_exists($class)){ $has_config = 0; }else{ $addon = new $class(); $has_config = count($addon->getConfig()); } ?>
							<?php if ($has_config): ?>
								<a href="<?php echo U('config',array('id'=>$vo['id']));?>">设置</a>
							<?php endif ?>
						<?php if ($vo['status'] >=0): ?>
							<?php if(($vo["status"]) == "0"): ?><a class="ajax-get" href="<?php echo U('enable',array('id'=>$vo['id']));?>">启用</a>
							<?php else: ?>
								<a class="ajax-get" href="<?php echo U('disable',array('id'=>$vo['id']));?>">禁用</a><?php endif; ?>
						<?php endif ?>
							
								<a class="ajax-get" href="<?php echo U('uninstall?id='.$vo['id']);?>">卸载</a>
							
						<?php else: ?>
							<a class="ajax-get" href="<?php echo U('install?addon_name='.$vo['name']);?>">安装</a><?php endif; ?>
					</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>

<div class="pagination">
	<ul><?php echo ($page); ?>
	</ul>
</div>

	</div>
	
	<script type="text/javascript" src="/timetravel/Admin/Public/static/jquery.nicescroll.js"></script>
	<script type="text/javascript" src="/timetravel/Admin/Public/static/bootstrap2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/timetravel/Admin/Public/Admin/js/common.js"></script>
	<script type="text/javascript" src="/timetravel/Admin/Public/Admin/js/layout.js"></script>
	<script type="text/javascript">
        /* 设置表单的值 */
    function setValue(name, value){
        var first = name.substr(0,1), input, i = 0, val;
        if(value === "") return;
        if("#" === first || "." === first){
            input = $(name);
        } else {
            input = $("[name='" + name + "']");
        }

        if(input.eq(0).is(":radio")) { //单选按钮
            input.filter("[value='" + value + "']").each(function(){this.checked = true});
        } else if(input.eq(0).is(":checkbox")) { //复选框
            if(!$.isArray(value)){
                val = new Array();
                val[0] = value;
            } else {
                val = value;
            }
            for(i = 0, len = val.length; i < len; i++){
                input.filter("[value='" + val[i] + "']").each(function(){this.checked = true});
            }
        } else {  //其他表单选项直接设置值
            input.val(value);
        }
    }
	</script>
	
</body>
</html>