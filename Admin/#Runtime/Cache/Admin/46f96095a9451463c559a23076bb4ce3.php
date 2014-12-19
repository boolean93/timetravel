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
<link href="/timetravel/admin/Public/static/kindeditor-4.1.10/themes/default/default.css" rel="stylesheet"
	type="text/css">

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
	<form class="form-horizontal" action="<?php echo U('saveConfig');?>">
		<input type="hidden" name="id" value="<?php echo I('id');?>">
		<?php if(empty($custom_config)): if(is_array($data['config'])): foreach($data['config'] as $o_key=>$form): ?><div class="control-group"">
					<label class="control-label">
						<?php echo ((isset($form["title"]) && ($form["title"] !== ""))?($form["title"]):''); ?>
						
					</label>
						<?php switch($form["type"]): case "text": ?><div class="controls">
								<input type="text" name="config[<?php echo ($o_key); ?>]" class="span8" value="<?php echo ($form["value"]); ?>">
							</div><?php break;?>
							<?php case "password": ?><div class="controls">
								<input type="password" name="config[<?php echo ($o_key); ?>]" class="span8" value="<?php echo ($form["value"]); ?>">
							</div><?php break;?>
							<?php case "hidden": ?><input type="hidden" name="config[<?php echo ($o_key); ?>]" value="<?php echo ($form["value"]); ?>"><?php break;?>
							<?php case "radio": ?><div class="controls">
								<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><label class="radio">
										<input type="radio" name="config[<?php echo ($o_key); ?>]" value="<?php echo ($opt_k); ?>" <?php if(($form["value"]) == $opt_k): ?>checked<?php endif; ?>><?php echo ($opt); ?>
									</label><?php endforeach; endif; ?>
							</div><?php break;?>
							<?php case "checkbox": ?><div class="controls">
								<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><label class="checkbox">
										<?php is_null($form["value"]) && $form["value"] = array(); ?>
										<input type="checkbox" name="config[<?php echo ($o_key); ?>][]" value="<?php echo ($opt_k); ?>" <?php if(in_array(($opt_k), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?>><?php echo ($opt); ?>
									</label><?php endforeach; endif; ?>
							</div><?php break;?>
							<?php case "select": ?><div class="controls">
								<select name="config[<?php echo ($o_key); ?>]" class="span8">
									<?php if(is_array($form["options"])): foreach($form["options"] as $opt_k=>$opt): ?><option value="<?php echo ($opt_k); ?>" <?php if(($form["value"]) == $opt_k): ?>selected<?php endif; ?>><?php echo ($opt); ?></option><?php endforeach; endif; ?>
								</select>
							</div><?php break;?>
							<?php case "textarea": ?><div class="controls">
								<label class="span8">
									<textarea name="config[<?php echo ($o_key); ?>]"><?php echo ($form["value"]); ?></textarea>
								</label>
							</div><?php break;?>
							<?php case "picture_union": ?><div class="controls">
								<input type="file" class="span8" id="upload_picture_<?php echo ($o_key); ?>">
								<input type="hidden" name="config[<?php echo ($o_key); ?>]" id="cover_id_<?php echo ($o_key); ?>" value="<?php echo ($form["value"]); ?>"/>
								<div class="upload-img-box">
									<?php if(!empty($form['value'])): $mulimages = explode(",", $form["value"]); ?>
									<?php if(is_array($mulimages)): foreach($mulimages as $key=>$one): ?><div class="upload-pre-item" val="<?php echo ($one); ?>">
											<img class="span8" src="<?php echo (get_cover($one,'path')); ?>"  ondblclick="removePicture<?php echo ($o_key); ?>(this)"/>
										</div><?php endforeach; endif; endif; ?>
								</div>
								</div>
								<script type="text/javascript">
									//上传图片
									/* 初始化上传插件 */
									$("#upload_picture_<?php echo ($o_key); ?>").uploadify({
										"height"          : 30,
										"swf"             : "/timetravel/admin/Public/static/uploadify/uploadify.swf",
										"fileObjName"     : "download",
										"buttonText"      : "上传图片",
										"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
										"width"           : 120,
										'removeTimeout'   : 1,
										'fileTypeExts'    : '*.jpg; *.png; *.gif;',
										"onUploadSuccess" : uploadPicture<?php echo ($o_key); ?>,
										'onFallback' : function() {
								            alert('未检测到兼容版本的Flash.');
								        }
									});

									function uploadPicture<?php echo ($o_key); ?>(file, data){
										var data = $.parseJSON(data);
										var src = '';
										if(data.status){
											src = data.url || '/timetravel/admin' + data.path
											$("#cover_id_<?php echo ($o_key); ?>").parent().find('.upload-img-box').append(
												'<div class="upload-pre-item" val="' + data.id + '"><img src="/timetravel/admin' + src + '" ondblclick="removePicture<?php echo ($o_key); ?>(this)"/></div>'
											);
											setPictureIds<?php echo ($o_key); ?>();
										} else {
											updateAlert(data.info);
											setTimeout(function(){
												$('#top-alert').find('button').click();
												$(that).removeClass('disabled').prop('disabled',false);
											},1500);
										}
									}
									function removePicture<?php echo ($o_key); ?>(o){
										var p = $(o).parent().parent();
										$(o).parent().remove();
										setPictureIds<?php echo ($o_key); ?>();
									}
									function setPictureIds<?php echo ($o_key); ?>(){
										var ids = [];
										$("#cover_id_<?php echo ($o_key); ?>").parent().find('.upload-img-box').find('.upload-pre-item').each(function(){
											ids.push($(this).attr('val'));
										});
										if(ids.length > 0)
											$("#cover_id_<?php echo ($o_key); ?>").val(ids.join(','));
										else
											$("#cover_id_<?php echo ($o_key); ?>").val('');
									}
								</script><?php break; endswitch;?>

					</div><?php endforeach; endif; ?>
		<?php else: ?>
			<?php if(isset($custom_config)): echo ($custom_config); endif; endif; ?>
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