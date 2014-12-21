<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Young 训练营</title>
<link href="/timetravel/Public/css/common.css" rel="stylesheet" type="text/css" />
<link href="/timetravel/Public/css/train.css" rel="stylesheet" type="text/css" />
<script src="/timetravel/Public/js/move.js" type="text/javascript"></script>
<script src="/timetravel/Public/js/switch.js" type="text/javascript"></script>
<script src="/timetravel/Public/js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script>
window.onload = function(){
	switchImg();
	show();
};
window.onscroll = function(){
	 var oFix = document.getElementById("fixed");
	 var oTop = getByClass(oFix,'f_t')[0];
	 oTop.onclick = function(){	
	 	startMove(oFix.srcollTop,{top:0});
	 };
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
        <a href="#"><img src="/timetravel/Public/image/weibo.png"/></a>
        <a href="#"><img src="/timetravel/Public/image/qq.png"/></a>
        <?php if(session('userinfo')): ?><span><?php echo getUserName();?></span>
            <a name="logout" href="<?php echo U('Index/logout');?>">注销</a>
        <?php else: ?>
            <a href="#" id="login">登陆</a>
            <a href="<?php echo U('Home/Index/register');?>" id="register">注册</a><?php endif; ?>
    </p>
</div>
<div id="nav">
    <div id="nav_main">
        <a href="<?php echo U('Home/Index/index');?>"><img src="/timetravel/Public/image/logo.png"/></a>
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
	<div id = "young-all"> 
	<div id = "young-all-program">
		<div class = "program-top">活动详情</div>
		<ul>
            <?php if(is_array($latest)): $i = 0; $__LIST__ = $latest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <img class="young_pic" src="<?php echo ($vo["pic_url"]); ?>" />
                    <div class = "program-text">
                        <a href="<?php echo U('Route/detail', array('id'=>$vo['id']));?>"><span><?php echo ($vo["title"]); ?></span></a>
                        <div class="station">
                            <img src="/timetravel/Public/image/station.jpg" />
                            <p>
                                <?php echo ($vo["travel_line"]); ?>
                            </p>
                        </div>
                        <dl class="date">
                            <dt style="float:left">最近团期：<?php echo (date("Y-m-d",$vo["start_time"])); ?></dt>
                            <dt><img src="/timetravel/Public/image/date.jpg" /><?php echo (date("Y-m-d",$vo["end_time"])); ?></dt>
                        </dl>
                    </div>
                    <span class="price">￥<?php echo (getpricebyrouteid($vo["route"])); ?></span>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<div class = "program-top">往期活动</div>
	</div>
	<div id = "img">
        <?php if(is_array($older)): $key = 0; $__LIST__ = $older;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><div class = "switch-img">
			<span class="dates"><?php echo ($key); ?></span>
			<div class="over">
				<div class="over-btn">
					<div class="move">
                        <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="switch-div">
                            	<?php if(is_array($v)): $k = 0; $__LIST__ = $v;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($k % 2 );++$k; if(($k == 1) or ($k == 3)): ?><ul class="img-ul"><?php endif; ?>
									<li onclick="window.location.href='<?php echo U('Route/detail', array('id'=>$o['id']));?>'">
										<img src="<?php echo ($o["pic_url"]); ?>" />
										<div class = "img-text">
											<span class = "text-span"><?php echo ($o["title"]); ?></span>
											<span class = "date-span"><?php echo (date('Y-m-d',$o["end_time"])); ?></span>
										</div>
									</li>
									<?php if(($k == 2) or ($k == 4) or ($k == count($v))): ?></ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
			<input type = "button" class = "pre" />
		</div><?php endforeach; endif; else: echo "" ;endif; ?>

		<!--<div class = "switch-img">-->
			<!--<div class = "over">-->
				<!--<span class="dates">2013</span>-->
				<!--<div class = "over-btn">-->
					<!--<div class = "move">-->
						<!--<div class = "switch-div">-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
						<!--</div>-->
						<!--<div class = "switch-div">-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
						<!--</div>-->
						<!--<div class = "switch-div">-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
						<!--</div>-->
						<!--<div class = "switch-div">-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
						<!--</div>-->
					<!--</div>-->
				<!--</div>-->
			<!--</div>-->
			<!--<input type = "button" class = "pre" />-->
		<!--</div>-->

		<!--<div class = "switch-img">-->
			<!--<div class = "over">-->
				<!--<span class="dates">2012</span>-->
				<!--<div class = "over-btn">-->
					<!--<div class = "move">-->
						<!--<div class = "switch-div">-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
						<!--</div>-->
						<!--<div class = "switch-div">-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
						<!--</div>-->
						<!--<div class = "switch-div">-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
						<!--</div>-->
						<!--<div class = "switch-div">-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
							<!--<ul class = "img-ul">-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/1.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
								<!--<li>-->
									<!--<img src = "/timetravel/Public/image/2.jpg" />-->
									<!--<div class = "img-text">-->
										<!--<span class = "text-span">#好哦煎熬的你什么的#</span>-->
										<!--<span class = "date-span">2014-10-15</span>-->
									<!--</div>-->
								<!--</li>-->
							<!--</ul>-->
						<!--</div>-->
					<!--</div>-->
				<!--</div>-->
			<!--</div>-->
			<!--<input type = "button" class = "pre" />-->
		<!--</div>-->
	</div>
</div><div id="login_box" style="background:#fff;z-indent:12px;opacity:1;">
    <h4>登陆<img id="cancel" src="/timetravel/Public/image/close.png" /></h4>
    <div class="l_left">
        <p>使用社交网络登陆</p>
        <span><a href="#"><img src="/timetravel/Public/image/l_web.png" /></a>新浪微博</span>
        <span class="qq"><a href="#"><img src="/timetravel/Public/image/l_qq.png" /></a><br />腾讯QQ</span>
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
<div id="footer">
    <div id="f_content">
        <div id="f_left">
            <img  class="f_logo" src="/timetravel/Public/image/logo.png" />
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
                <a href="#"><img src="/timetravel/Public/image/f_web.png" /></a>
                <a href="#"><img src="/timetravel/Public/image/f_qq.png" /></a>
            </p>
        </div>
        <div id="f_right">
            <img src="/timetravel/Public/image/erw.png" />
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
    <h4>登陆<img id="cancel" src="/timetravel/Public/image/close.png" /></h4>
    <div class="l_left">
        <p>使用社交网络登陆</p>
        <span><a href="#"><img src="/timetravel/Public/image/l_web.png" /></a>新浪微博</span>
        <span class="qq"><a href="#"><img src="/timetravel/Public/image/l_qq.png" /></a>腾讯QQ</span>
    </div>
    <div class="l_right">
        <p><a class="l_first" href="#">使用本网账号登陆</a><a class="l_last" href="#">注册</a></p>
        <form action="#" method="post">
            <input type="text" name="username">
            <input type="password" name="password">
            <p class="tell">
                <span><input type="checkbox" class="radio"/>记住我</span><a href="#">忘记密码?</a>
            </p>
            <input type="submit" class="l_sub" value="登陆">
        </form>
    </div>
</div>
</body>
</html>