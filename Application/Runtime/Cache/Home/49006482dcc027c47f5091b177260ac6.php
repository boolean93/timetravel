<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>时光之旅</title>
<link href="/Public/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Public/css/travel.css" rel="stylesheet" type="text/css" />
<script src="/Public/js/jquery-1.8.2.min.js"></script>
<script>
window.onload = function(){
	var oD = document.getElementById('order');
	oD.style.width=document.body.clientWidth+'px';
    oD.style.height=document.body.clientHeight+'px';
    oD.style.filter = 'alpha(opacity=50)';
    oD.style.opacity = 0.5;
    oD.style.background = '#000';
    var oDe  = document.getElementById('login_box');
    var oY = document.getElementById('login');
    var oN = document.getElementById('cancel');
     var te = (document.documentElement.clientWidth-772)/2 +'px';
    oDe.style.left = te;
    oY.onclick =function(){
         oD.style.display = 'block';
          oDe.style.display = 'block';
    }
    oN.onclick = function(){
    	oD.style.display = 'none';
        oDe.style.display = 'none';
    }
}
function getByClass(oparent,sClass){
		var aResult=[];
		var aEle = oparent.getElementsByTagName('*');
		for(var i=0;i<aEle.length;i++){
			if(aEle[i].className==sClass){
				aResult.push(aEle[i]);
			}
		}
		return aResult;
}
window.onscroll = function(){
	 var oFix = document.getElementById("fixed");
	 var oTop = getByClass(oFix,'f_t')[0];
	 oTop.onclick = function(){	
	 	startMove(oFix.srcollTop,{top:0});
	 }
	if (document.documentElement.scrollTop + document.body.scrollTop > 360) { 
	    oFix.style.display = "block"; 
	} 
	else { 
	     oFix.style.display = "none"; 
	} 
}
</script>
<script>
$(function(){
        showScroll();
        function showScroll(){
            $(window).scroll( function() { 
                var scrollValue=$(window).scrollTop();
                scrollValue > 100 ? $('a[class=f_t]').fadeIn():$('a[class=f_t]').fadeOut();
            } );    
            $('.f_t').click(function(){
                $("html,body").animate({scrollTop:0},200);  
            }); 
        }
 });
</script>
</head>
<!--its in nav-->
<body id="main">
<div id="top">
    <p>
        <a href="#"><img src="/Public/image/weibo.png"/></a>
        <a href="#"><img src="/Public/image/qq.png"/></a>
        <?php if(session('userinfo')): ?><span><?php echo getUserName();?></span>
            <a name="logout" href="<?php echo U('Index/logout');?>">注销</a>
        <?php else: ?>
            <a href="#" id="login">登陆</a>
            <a href="<?php echo U('Home/Index/register');?>" id="register">注册</a><?php endif; ?>
    </p>
</div>
<div id="nav">
    <div id="nav_main">
        <a href="<?php echo U('Home/Index/index');?>"><img src="/Public/image/logo.png"/></a>
        <ul>
            <li><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
            <li><a href="<?php echo U('Home/Time/index');?>">时光之旅</a></li>
            <li><a href="<?php echo U('Home/Explore/index');?>">极致探险</a></li>
            <li><a href="<?php echo U('Home/Young/index');?>">Young探险</a></li>
            <li><a href="<?php echo U('Home/Memory/index');?>">时光印记</a></li>
            <li><a href="">时光小铺</a></li>
        </ul>
        <div class="search">
            <form action="#" method="post">
                <input type="text" class="soso" value="搜索路线/目的" onclick="this.value = ''">
                <input type="submit" class="sub_go" value="">
            </form>
        </div>
    </div>
</div>
<!--nav ends-->
	<div id="t_content">
		<div class="t_left">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="t_leftmain">
                    <img src="<?php echo ($vo["header_img"]); ?>">
                    <span><a href="<?php echo U('Home/Time/Detail', array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></span>
                    <div class="t_content">
                    <p><?php echo (mb_substr(strip_tags(htmlspecialchars_decode($vo["content"])),0,250)); ?><a href="<?php echo U('Article/detail', array('id'=>$vo['id']));?>">查看全文</a></p>
                	</div>
                    <?php if(count($vo['route']) > 0): ?><span class="route_detail">相关路线</span>
                        <?php if(is_array($vo['route'])): $i = 0; $__LIST__ = $vo['route'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><div class="route">
                                <img src="/Public/image/route.png" />
                                <span class="t_title"><?php echo ($r["title"]); ?></span>
                                <span>时间：<?php echo (date("Y.m.d",$r["start_time"])); ?>-<?php echo (date("Y.m.d",$r["end_time"])); ?></span>
                                <span><?php echo (date("Y.m.d",$r["create_time"])); ?>发布</span>
                                <a href="<?php echo U('Route/detail', array('id'=>$r['id']));?>" class="t_look">查看路线</a>
                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>

			<p class="page">
				<a href="<?php echo lastPageUrl('Article', 'home/time/index', $_GET['pid'], 'pid', array('type'=>'time'));?>">上一页</a>
				<?php if(is_array($page)): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo != '...'): ?><a <?php if($vo == $pid): ?>class="t_active"<?php endif; ?> href="<?php echo U('Home/Time/index', array('pid' => $vo));?>"><?php echo ($vo); ?></a>
						<?php else: ?>
						<a href="#">...</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				<a href="<?php echo nextPageUrl('Article', 'home/time/index', $_GET['pid'], 'pid', array('type'=>'time'));?>">下一页</a>
			</p>
		</div>
		<div class="t_right">
			<a herf="#">
				<div class="talk">
					<span>在线支付</span>
					<span>123456789</span>
				</div>
				<div class="er_code">
					<p>
						<img src="/Public/image/er_code.png" />
					</p>
					<span>关注微信二维码</span>
				</div>
				<div class="er_code">
					<p>
						<img src="/Public/image/er_code.png" />
					</p>
					<span>关注微博二维码</span>
				</div>
			</a>
		</div>
	</div>
	<div id="footer">
		<div id="f_content">
			<div id="f_left">
			<img  class="f_logo" src="/Public/image/logo.png" />
			<span>备案J1541558436[京] </span>
			</div>
			<div id="f_center">
				<p>
					<a href="#">关于我们</a>    
					<a href="#">联系我们</a>     
					<a href="#">隐私条款</a>     
					<a href="#">加入我们</a>
				</p>
				<p class="f_pic">
					<a href="#">关于我们:</a>    
					<a href="#"><img src="/Public/image/f_web.png" /></a>
					<a href="#"><img src="/Public/image/f_qq.png" /></a>
				</p>
			</div>
			<div id="f_right">
				<img src="/Public/image/erw.png" />
				<span>扫一扫关注时光旅行</span>
			</div>
		</div>
		<div id="f_bottom">
			<span>友情链接</span>
			<p>
				<a href="#">关于我们</a>    
				<a href="#">联系我们</a>     
				<a href="#">隐私条款</a>     
				<a href="#">加入我们</a>
				<a href="#">关于我们</a>    
				<a href="#">联系我们</a>     
				<a href="#">隐私条款</a>     
				<a href="#">加入我们</a>
				<a href="#">加入我们</a>
				<a href="#">关于我们</a>    
			</p>
			<p>
				<a href="#">关于我们</a>    
				<a href="#">联系我们</a>     
				<a href="#">隐私条款</a>     
				<a href="#">加入我们</a>
				<a href="#">关于我们</a>    
				<a href="#">联系我们</a>     
				<a href="#">隐私条款</a>     
				<a href="#">加入我们</a>
				<a href="#">加入我们</a>
				<a href="#">关于我们</a>    
			</p>
		</div>
	</div>
	<div id="fixed">
		<ul>
			<li><a class="f_f" href="#">在线咨询</a></li>
			<li><a class="f_s" href="#">123456789</a></li>
			<li><a class="f_t" href="javascript:void(0);">回到顶部</a></li>
		</ul>
	</div>
	<div id="order">
	</div>
<div id="login_box" style="background:#fff;z-indent:12px;opacity:1;">
    <h4>登陆<img id="cancel" src="/Public/image/close.png" /></h4>
    <div class="l_left">
        <p>使用社交网络登陆</p>
        <span><a href="#"><img src="/Public/image/l_web.png" /></a>新浪微博</span>
        <span class="qq"><a href="#"><img src="/Public/image/l_qq.png" /></a><br />腾讯QQ</span>
    </div>
    <div class="l_right">
        <p><a class="l_first" href="#">使用本网账号登陆</a><a class="l_last" href="#">注册</a></p>
        <form action="<?php echo U('Index/login');?>" method="post">
            <input type="text" name="username">
            <input type="password" name="password">
            <p class="tell">
                <span><input name="remember" type="checkbox" class="radio"/>记住我</span><a href="#">忘记密码?</a>
            </p>
            <input type="submit" class="l_sub" value="登陆">
        </form>
    </div>
</div>
</body>
</html>