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
	<li>
		<a href="javascript:history.back(-1)">返回上一页</a>
		<span class="divider">/</span>
	</li>
	<li class="active"><?php echo ($meta_title); ?></li>
</ul>
<div class="row-fluid">
	<form class="form-horizontal" action="<?php echo U('editAction');?>">
		<input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
		<div class="control-group">
			<label class="control-label" for="name">行为名称</label>
			<div class="controls">
				<span><?php echo get_action($info['action_id'], "title");?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="title">执行者</label>
			<div class="controls">
				<span><?php echo get_nickname($info['user_id']);?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="remark">执行IP</label>
			<div class="controls">
				<span><?php echo long2ip($info['action_ip']);?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="title">执行时间</label>
			<div class="controls">
				<span><?php echo date('Y-m-d H:i:s',$info['create_time']);?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="title">备注</label>
			<div class="controls">
				<span><?php echo ($info["remark"]); ?></span>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="button" class="btn"
					onclick="javascript:history.back(-1)">返回</button>
			</div>
		</div>
	</form>
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
	 <script type="text/javascript">
  setValue("status", <?php echo ((isset($info["status"]) && ($info["status"] !== ""))?($info["status"]): 0); ?>);
  </script> 
</body>
</html>