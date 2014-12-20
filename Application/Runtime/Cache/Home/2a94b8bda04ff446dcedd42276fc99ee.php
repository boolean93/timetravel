<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>时光旅行</title>
<link href="/timetravel/Public/css/common.css" rel="stylesheet" type="text/css" />
<link href="/timetravel/Public/css/index.css" rel="stylesheet" type="text/css" />
<script src="/timetravel/Public/js/move.js" text="javascript/text"></script>
<script src="/timetravel/Public/js/index.js" text="javascript/text"></script>
<script src="/timetravel/Public/js/jquery-1.8.2.min.js"></script>
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
<script>
window.onload = function(){
	show();
}
</script>

</head>
<!--its in nav-->
<body id="main">
<div id="top">
    <p>
        <a href="#"><img src="/timetravel/Public/image/weibo.png"/></a>
        <a href="#"><img src="/timetravel/Public/image/qq.png"/></a>
        <?php if(session('userinfo')): else: ?>
            <a href="#" id="login">登陆</a>
            <a href="<?php echo U('Home/Index/register');?>" id="register">注册</a><?php endif; ?>
        <a href=""></a>
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
	<div id="slider">
		<img id="prev" src="/timetravel/Public/image/prev.png"/>
		<img id="next" src="/timetravel/Public/image/next.png"/>
		<ul>
            <?php if(is_array($slider)): $i = 0; $__LIST__ = $slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="#"><img src="<?php echo ($vo["img_url"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<div id="forms">
			<form action="#" method="post">
				<h4>私人定制</h4>
				<p><span>目的地</span><input type="text" name="place">
				</p>
				<p><span>特色主题</span>
					<select  name="place">
						<option value>所有主题</option>
						<option>轻松休闲</option>
						<option>人文体验</option>
					</select>
				</p>
				<p><span>时长</span>
					<select  name="place">
						<option value>所有时长</option>
						<option>1天</option>
						<option>2-4天</option>
					</select>
				</p>
				<p><span>价格</span>
					<select  name="place">
						<option value>所有价格</option>
						<option><99元</option>
						<option>100-200元</option>
					</select>
				</p>
				<p><span>关键词</span><input type="text" name="place">
				</p>
				<input class="submit" type="submit" value="立即提交">
			</form>
		</div>
	</div>

	<div id="travel">
		<span><a href="#">时光之旅</a></span>
		<img class="f_prev" src="/timetravel/Public/image/tprev.png"/>
		<img class="f_next" src="/timetravel/Public/image/f_prev.png"/>
		<div id="looks">
			<div id="pic_look">
                <?php if(is_array($time)): $i = 0; $__LIST__ = $time;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="look">
                        <ul>
                            <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
                                    <img src="<?php echo ($v["pic_url"]); ?>"/>
                                    <a href="<?php echo U('Route/detail', array('id'=>$v['id']));?>" class="test">
                                        <h4><?php echo ($v["title"]); ?></h4>
                                        <p><?php echo ($v["travel_line"]); ?></p>
                                        <h4>￥<?php echo (getlowestpricebyrouteid($v['id'])); ?>/1人</h4>
                                        <p class="detal">查看详情</p>
                                    </a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>

	<div id="explore">
		<span><a href="<?php echo U('Explore/index');?>">极致探险</a></span>
		<div id="sliders">
			<img class="s_prev" src="/timetravel/Public/image/s_prev.png" />
			<img class="s_next" src="/timetravel/Public/image/s_next.png" />
			<div class="pic_side">
				<span>极致探险</span>
				<p>生命是一段美好的旅程，我们在生活中紧紧相拥，我们用认真的态度的对待每一天，经费噶接法界个二哥，生活美好，认真对待。</p>
				<p>美好的生活要来啦，快来参与吧，你好我好大家好，世界因你而美好，极致探险，真棒。</p>
			</div>
			<ul>
                <?php if(is_array($extreme)): $i = 0; $__LIST__ = $extreme;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo U('Route/detail', array('id'=>$vo['id']));?>">
                            <img src="<?php echo ($vo["pic_url"]); ?>"/>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>

	<div id="train">
		<span><a href="#">Young 训练营</a></span>
		<div class="left_train">
            <?php echo ($youngIntro["other"]); ?>
			<a href="<?php echo U('Young/index');?>" class="more">了解更多详情</a>
		</div>
		<div class="right_train">
			<img class="t_prev" src="/timetravel/Public/image/s_prev.png" />
			<img class="t_next" src="/timetravel/Public/image/s_next.png" />
            <?php if(is_array($youngImg)): $k = 0; $__LIST__ = $youngImg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; switch($k): case "1": ?><img class="big_pic"<?php break;?>
                    <?php case "2": ?><img class="small_pic" style="filter:alpha(opacity:100);opacity:1;"<?php break;?>
                    <?php case $youngCount: ?><img class="small_pic" id="lasts"<?php break;?>
                    <?php default: ?><img class="small_pic"<?php endswitch;?> src="<?php echo ($vo["pic_url"]); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	<div id="memory">
		<span class="m_title"><a href="#">时光印记</a></span>
		<ul>
            <?php if(is_array($memory)): $i = 0; $__LIST__ = $memory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <a class="m_content" href="<?php echo U('Memory/detail', array('id'=>$vo['id']));?>">
                        <p class="content"><?php echo (mb_substr(strip_tags(htmlspecialchars_decode($vo["content"])),0,45,"UTF-8")); ?></p>
                    </a>
                    <a href="<?php echo U('Memory/detail', array('id'=>$vo['id']));?>"><h4 class="from"><?php echo ($vo["title"]); ?></h4></a>
                    <p class="author"><span class="write">作者:<?php echo (getusernamebyuserid($vo["user_id"])); ?></span><span class="dates">
                        <?php echo (date("Y-m-d",$vo["create_time"])); ?></span>
                        <b class="b_first"><?php echo ($vo["click"]); ?></b><b class="b_last"><?php echo ($vo["good"]); ?></b>
                    </p>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
	<div id="store">
		<span><a href="#">时光小铺</a></span>
		<a href="#"><img src="/timetravel/Public/image/store.gif" /></a>
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
<?php  ?>
</body>
</html>