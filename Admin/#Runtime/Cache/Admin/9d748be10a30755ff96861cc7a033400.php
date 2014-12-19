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
	

<link href="/timetravel/Admin/Public/static/ztree/css/zTreeStyle/zTreeStyle.css"
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
	<form class="form-horizontal" action="<?php echo U('auth');?>">
		<input type="hidden" name="uid" value="<?php echo ((isset($info["uid"]) && ($info["uid"] !== ""))?($info["uid"]):''); ?>">
		<div class="control-group">
			<label class="control-label" for="title">权限分配</label>
			<div class="controls">
			<ul id="authtree" class="ztree"></ul>
			</div>
		</div>
		

		<div class="control-group">
			<div class="controls">
				<button type="button" class="btn"
					target-form="form-horizontal" onclick="getTreeCheck()">授权</button>
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
	src="/timetravel/Admin/Public/static/ztree/js/jquery.ztree.core-3.5.min.js"></script> 
	<script type="text/javascript"
	src="/timetravel/Admin/Public/static/ztree/js/jquery.ztree.excheck-3.5.min.js"></script> 
 <script type="text/javascript">
	var setting = {
			check: {
				enable: true
			},
			data: {
				simpleData: {
					enable: true
				}
			}
		};

		var zNodes =<?php echo ($Auth); ?>;
		
	
		
		$(document).ready(function(){
			$.fn.zTree.init($("#authtree"), setting, zNodes);

		});
	

		function getTreeCheck(){
			var str='';
			var treeObj = $.fn.zTree.getZTreeObj("authtree");
			var nodes = treeObj.getCheckedNodes(true);
			for(var i = 0, l = nodes.length; i < l; i++) {
				str+=nodes[i].id;
				if(i!=l-1)
				{
					str+=",";
				}
			}

            	target ='<?php echo U('auth');?>' ;
    
			$.post(target,'auth='+str+'&uid='+<?php echo ($info["uid"]); ?>).success(function(data){
                if (data.status==1) {
                    if (data.url) {
                        updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
                    }else{
                        updateAlert(data.info ,'alert-success');
                    }
                    setTimeout(function(){
                        if (data.url) {
                            location.href=data.url;
                        }else if( $(that).hasClass('no-refresh')){
                            $('#top-alert').find('button').click();
                            $(that).removeClass('disabled').prop('disabled',false);
                        }else{
                            location.reload();
                        }
                    },1500);
                }else{
                    updateAlert(data.info);
                    setTimeout(function(){
                        if (data.url) {
                            location.href=data.url;
                        }else{
                            $('#top-alert').find('button').click();
                            $(that).removeClass('disabled').prop('disabled',false);
                        }
                    },1500);
                }
            });
			
		}
  </script> 
</body>
</html>