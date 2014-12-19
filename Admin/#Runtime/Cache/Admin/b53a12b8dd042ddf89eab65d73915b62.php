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
	
    <script src="/timetravel/Admin/Public/js/jquery-2.0.2.js"></script>
    <script src="/timetravel/Admin/Public/ueditor/ueditor.config.js" ></script>
    <script src="/timetravel/Admin/Public/ueditor/ueditor.all.min.js" ></script>

    <link href="/timetravel/Admin/Public/static/bootstrap2/css/bootstrap-datetimepicker.min.css"
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
	<form class="form-horizontal" action="<?php echo U('add');?>" method="post">
		<input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
		<div class="control-group">													
			<label class="control-label" for="title">标题</label>
			<div class="controls">
				<input type="text" id="title" name="title" class="span8"
					placeholder="标题" value="<?php echo ($info["title"]); ?>">
			</div>
		</div>

        <div class="control-group">
            <label class="control-label" for="travel_line">路线</label>
            <div class="controls">
                <input type="text" id="travel_line" name="travel_line" class="span8"
                       placeholder="如: 重庆-九寨沟-黄龙-成都" value="<?php echo ($info["travel_line"]); ?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="pic_url">封面图片地址</label>
            <div class="controls">
                <input type="text" id="pic_url" name="pic_url" class="span8"
                       placeholder="图片地址" value="<?php echo ($info["pic_url"]); ?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="start">开始时间</label>
            <div class="controls">
                <input type="text" id="start" name="start_time" class="span8"
                       placeholder="如:2012.08.12 12:00:00" value="<?php echo ($info["start_time"]); ?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="end">结束时间</label>
            <div class="controls">
                <input type="text" id="end" name="end_time" class="span8"
                       placeholder="如:2012.08.12 12:00:00" value="<?php echo ($info["end_time"]); ?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="type">类别</label>
            <div class="controls">
                <select id="type" name="type" class="span8">
                    <option value="time">时光之旅</option>
                    <option value="extreme">极致活动</option>
                    <option value="young">Young活动</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="myEditor">内容</label>
            <div class="controls">
                <textarea name="content" id="myEditor"></textarea>
            </div>
        </div>

        <script>
            $(function(){
                var ue = UE.getEditor('myEditor',{
                    serverUrl :'<?php echo U("Admin/Article/ueditor");?>',
                    initialFrameWidth   : 700
                });
            })
        </script>
		<!--<div class="control-group">-->
			<!--<label class="control-label" for="copyfrom">来源</label>-->
			<!--<div class="controls">-->
				<!--<input type="text" name="copyfrom" id="copyfrom" class="span8"-->
					<!--value="<?php echo ($info["copyfrom"]); ?>" placeholder="来源">-->
			<!--</div>-->
		<!--</div>-->
<!--
		<div class="control-group">
			<label class="control-label" for="status">状态</label>
			<div class="controls">
				<select id="status" name="status" class="span8">
					<option value="1">启用</option>
					<option value="0">禁用</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="commentflag">允许评论</label>
			<div class="controls">
				<select id="commentflag" name="commentflag" class="span8">
					<option value="1">启用</option>
					<option value="0">禁用</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="author">作者</label>
			<div class="controls">
				<input type="text" name="author" id="author" class="span8"
					value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):session('user_auth.nickname')); ?>" placeholder="作者">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="click">点击数</label>
			<div class="controls">
				<input type="text" name="click" id="click" class="span8"
					value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>" placeholder="点击数">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="publishtime">发布时间</label>
			<div class="controls">
				<input type="text" name="publishtime" id="publishtime" class="span8"
					value="<?php echo ($info["publishtime"]); ?>" placeholder="发布时间"
					data-date-format="yyyy-mm-dd hh:ii" readonly>

			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="content">内容</label>
			<div class="controls">
				<textarea rows="3" name="content" class="span8"
					placeholder="内容"><?php echo ($info["content"]); ?></textarea>
					<?php echo hook('adminArticleEdit', array('name'=>'content','value'=>$info['content']));?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="keywords">关键字</label>
			<div class="controls">
				<textarea rows="3" name="keywords" id="keywords" class="span8"
					placeholder="关键字"><?php echo ($info["keywords"]); ?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="description">摘要描述</label>
			<div class="controls">
				<textarea rows="3" name="description" id="description" class="span8"
					placeholder="摘要描述"><?php echo ($info["description"]); ?></textarea>
			</div>
		</div> -->
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
	 <script type="text/javascript"
	src="/timetravel/Admin/Public/static/bootstrap2/js/bootstrap-datetimepicker.min.js">
</script> 
	<script type="text/javascript">
$('#publishtime').datetimepicker({ language:'zh-CN'}); 
setValue("pid", <?php echo ((isset($info["pid"]) && ($info["pid"] !== ""))?($info["pid"]):0); ?>); 
setValue("status", <?php echo ((isset($info["status"]) && ($info["status"] !== ""))?($info["status"]): 1); ?>); 



</script>

</script> 
</body>
</html>