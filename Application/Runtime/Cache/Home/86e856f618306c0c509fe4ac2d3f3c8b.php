<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>时光之旅</title>
<link href="/Public/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Public/css/explore.css" rel="stylesheet" type="text/css" />
<script src="/Public/js/move.js" type="text/javascript"></script>
<script src="/Public/js/jquery-1.8.2.min.js" type="text/javascript"></script>
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
    var nowss =0;
    var oIn = document.getElementById('l_main_g');
    var oUl1 =oIn.getElementsByTagName('ul')[0];
    var aLi1 =oUl1.getElementsByTagName('li');
    oUl1.style.width =aLi1[0].offsetWidth*aLi1.length+'px';
    var o_prev = getByClass(oIn,'intro_prev')[0];
    var o_next = getByClass(oIn,'intro_next')[0];
    var away = (document.documentElement.clientWidth-1148)/2 +'px';
    o_next.style.right = away;
    o_prev.style.left = away;
 	o_next.onclick = function(){
 		nowss--;
 		if(nowss==-1){
 			nowss = aLi1.length -1;
 		}
 		startMove(oUl1,{left:-aLi1[0].offsetWidth*nowss});
 	}
 	o_prev.onclick = function(){
 		nowss++;
 		if(nowss==aLi1.length){
 			nowss=0;
 		}
 		startMove(oUl1,{left:-aLi1[0].offsetWidth*nowss});
 	}

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
<<<<<<< HEAD
        <a href="#"><img src="/Public/image/weibo.png"/></a>
        <a href="#"><img src="/Public/image/qq.png"/></a>
=======
        <a href="#"><img src="/timetravel/Public/image/weibo.png"/></a>
        <a href="#"><img src="/timetravel/Public/image/qq.png"/></a>
>>>>>>> 9f863b7dfd1e1db90baa1d624c48f64b5fa057d6
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
	<div class="l_main clear">
	<div class="bg_img">
		<div id ="bg_title">
			<p>
				<?php echo ($stuff[0]["other"]); ?>	
			</p>
		</div>
	</div>
    <div class="l_main_g">
    	<div class="main_center">
        	<div class="main_c1">
            	<div class="c1_font">
                    <p class="b"><?php echo ($stuff[1]["other"]); ?></p>
            	</div>
            </div>
        </div>
    </div>
    <div class="l_main_w clear">
    	<div class="main_center clear">
        	<p class="w_font">活动详情</p>
            <?php if(is_array($activity)): $k = 0; $__LIST__ = $activity;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($k % 2 == 1): ?><div class="text_img"><?php endif; ?>
                <div class="img_<?php echo ($k); ?> <?php if($k % 2 == 0): ?>m_left<?php endif; ?>">
                    <a href="<?php echo U('Route/detail', array('id'=>$vo['id']));?>">
                        <img src="<?php echo ($vo["pic_url"]); ?>">
                    </a>
                    <a href="<?php echo U('Route/detail', array('id'=>$vo['id']));?>">
                        <p><?php echo ($vo["title"]); ?></p>
                    </a>
                </div>
            <?php if($k % 2 == 0): ?></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div id="l_main_g">
    	<img class="intro_prev" src="/Public/image/intro_prev.png" />
        <img class="intro_next" src="/Public/image/intro_next.png" />
    	<div class="main_center">
        	<p class="w_font">领队介绍</p>
        	<div id="f_js">
        		<span>王牌领队</span>
        		<ul>
                    <?php if(is_array($leader)): $i = 0; $__LIST__ = $leader;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('leader', array('id'=>$vo['id']));?>">
                            <img src="<?php echo ($vo["header_img"]); ?>" />
                        </a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        		</ul>
        	</div>
        </div>
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