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
	
<link href="/timetravel/admin/Public/static/bootstrap2/css/bootstrap-datetimepicker.min.css"
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
</ul>
<div class="row-fluid">
	<form class="form-horizontal" action="<?php echo U('updateHook');?>">
		<input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
		<div class="control-group">
			<label class="control-label" for="name">钩子名称</label>
			<div class="controls">
				<input type="text" id="name" name="name" class="span8"
					placeholder="钩子名称" value="<?php echo ($info["name"]); ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="description">钩子描述</label>
			<div class="controls">
				<input type="text" id="description" name="description" class="span8"
					placeholder="钩子描述" value="<?php echo ($info["description"]); ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="type">钩子类型</label>
			<div class="controls">
				<select id="type" name="type" class="span8">
				<?php $_result=C('HOOKS_TYPE');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($info["type"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="description">摘要描述</label>
			<div class="controls">
				<textarea rows="3" name="description" id="description" class="span8"
					placeholder="摘要描述"><?php echo ($info["description"]); ?></textarea>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn ajax-post"
					target-form="form-horizontal">保存</button>
				<button type="button" class="btn"
					onclick="javascript:history.back(-1)">取消</button>
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

setValue("status", <?php echo ((isset($info["status"]) && ($info["status"] !== ""))?($info["status"]): 1); ?>); 

</script> 
</body>
</html>