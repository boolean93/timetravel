<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" content="text/html" http-equiv="content-type" />
<title>OneDream管理平台</title>
<script type="text/javascript" src="/timetravel/admin/Public/static/jquery-1.10.2.min.js"></script>
<link href="/timetravel/admin/Public/Admin/css/default/style.css" rel="stylesheet" type="text/css">
<link href="/timetravel/admin/Public/static/bootstrap2/css/bootstrap.min.css" rel="stylesheet"
	type="text/css">
<link href="/timetravel/admin/Public/static/bootstrap2/css/bootstrap-responsive.min.css"
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
<li><a href="javascript:history.back(-1)">返回上一页</a> <span class="divider">/</span></li>
  <li class="active"><?php echo ($meta_title); ?></li>
  <li><a class="btn btn-link" href="<?php echo U('addAction');?>">新增行为</a></li>
</ul>

<table class="table table-hover table-striped table-bordered">
	<thead>
		<tr>
			<th>行为说明</th>
			<th>行为唯一标识</th>
			<th>描述</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($vo["name"]); ?></td>
			<td><?php echo ($vo["title"]); ?></td>
			<td><?php echo ($vo["remark"]); ?></td>
			<td><?php echo ($vo["status_text"]); ?></td>
			<td>
			<a class="btn btn-mini" href="<?php echo U('editAction?id='.$vo['id']);?>">编辑</a>
			<a class="btn btn-mini ajax-get  confirm" href="<?php echo U('delete?id='.$vo['id']);?>">删除</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>
<div class="pagination">
  <ul>
<?php echo ($_page); ?>
  </ul>
</div>

	</div>
	
	<script type="text/javascript" src="/timetravel/admin/Public/static/jquery.nicescroll.js"></script>
	<script type="text/javascript" src="/timetravel/admin/Public/static/bootstrap2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/timetravel/admin/Public/Admin/js/common.js"></script>
	<script type="text/javascript" src="/timetravel/admin/Public/Admin/js/layout.js"></script>
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