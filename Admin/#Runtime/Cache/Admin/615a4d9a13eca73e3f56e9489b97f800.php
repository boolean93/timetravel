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
</ul>
<div class="row-fluid">
 <form class="form-horizontal" action="<?php echo U('edit');?>">
<input type="hidden" name="uid" value="<?php echo ((isset($info["uid"]) && ($info["uid"] !== ""))?($info["uid"]):''); ?>">
  <div class="control-group">
    <label class="control-label" for="username">用户名</label>
    <div class="controls">
      <input type="text" id="username" name="username" class="span8" placeholder="用户名" <?php echo isset($info['uid'])?'readonly="true"':'';?> value="<?php echo ($info["username"]); ?>">
    </div>
  </div>
        <div class="control-group">
    <label class="control-label" for="roleid">角色</label>
    <div class="controls">
      <select id="roleid" name="roleid" class="span8">
      <?php if(is_array($Role)): $i = 0; $__LIST__ = $Role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="nickname">昵称</label>
    <div class="controls">
      <input type="text" name="nickname" id="nickname" class="span8" value="<?php echo ($info["nickname"]); ?>" placeholder="昵称">
    </div>
  </div>
      <div class="control-group">
    <label class="control-label" for="nickname">密码</label>
    <div class="controls">
      <input type="text" name="password" id="password" class="span8" value="" placeholder="密码">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="sex">性别</label>
    <div class="controls">
      <select id="sex" name="sex" class="span8">
          <option value="0">男</option>
          <option value="1">女</option>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="birthday">生日</label>
    <div class="controls">
      <input type="text" name="birthday" id="birthday" class="span8" value="<?php echo ($info["birthday"]); ?>" placeholder="生日">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="qq">QQ号码</label>
    <div class="controls">
      <input type="text" name="qq" id="qq" class="span8" value="<?php echo ($info["qq"]); ?>" placeholder="QQ号码">
    </div>
  </div>
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
    <div class="controls">
      <button type="submit" class="btn ajax-post" target-form="form-horizontal">保存</button><button type="button" class="btn" onclick="javascript:history.back(-1)">取消</button>
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
  setValue("sex", <?php echo ((isset($info["sex"]) && ($info["sex"] !== ""))?($info["sex"]): 0); ?>);
  setValue("status", <?php echo ((isset($info["status"]) && ($info["status"] !== ""))?($info["status"]): 1); ?>);
  setValue("roleid", <?php echo ($info["roleid"]); ?>);
  </script>

</body>
</html>