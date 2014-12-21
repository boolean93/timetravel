<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>时光之旅</title>
<link href="/timetravel/Public/css/common.css" rel="stylesheet" type="text/css" />
<link href="/timetravel/Public/css/book.css" rel="stylesheet" type="text/css" />
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
	
	var oDiv = document.getElementById('b_content');
	var oChose = getByClass(oDiv,'chose')[0];
	var aSpan = oChose.getElementsByTagName('span');
	for(var i =0,len = aSpan.length;i<len;i++){
		aSpan[i].onclick = function(){
			for(var i =0,len = aSpan.length;i<len;i++){
				aSpan[i].style.cssText= 'border:1px solid #404040;';
			}
			this.style.cssText= 'border:1px solid red;';
		}
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
	<div id="b_content">
		<div class="b_left">
			<div class="b_leftmain">
				<img src="/timetravel/Public/image/book.png" />
				<div class="b_main">
					<p class="b_title"><?php echo ($detail["title"]); ?></p>
					<span class="b_address"><?php echo ($detail["travel_line"]); ?></span>
					<a class="totaobao" href="<?php echo ($detail["taobao"]); ?>">前去下单</a>
					<p>费用：<?php echo (getpricebyrouteid($detail["id"])); ?></p>
				</div>
				<p class="b_share">
                    分享：
                    <div class="bdsharebuttonbox">
                        <a href="#" class="bds_more" data-cmd="more"></a>
                        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    </div>
                    <script>
                        window._bd_share_config={
                            "common":{
                                "bdSnsKey":{},
                                "bdText":"<?php echo ($detail["title"]); ?>",
                                "bdMini":"1",
                                "bdMiniList":false,
                                "bdPic":"",
                                "bdStyle":"1",
                                "bdSize":"16"
                            },
                            "share":{}
                        };
                        var bds_config = {
                            'bdText':'<?php echo ($detail["title"]); ?>',
                            'bdDesc':'<?php echo (strip_tags(htmlspecialchars_decode($detail["content"]))); ?>'
                        };
                        with(document)0[
                                (getElementsByTagName('head')[0]||body)
                                        .appendChild(createElement('script'))
                                        .src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                    </script>
                </p>
			</div>
			<div class="pics">
				<?php echo (htmlspecialchars_decode($detail["content"])); ?>
			</div>
		</div>
		<div class="b_right">
			<a herf="#">
				<div class="talk">
					<span>在线支付</span>
					<span>123456789</span>
				</div>
				<div class="er_code">
					<p>
						<img src="/timetravel/Public/image/er_code.png" />
					</p>
					<span>关注微信二维码</span>
				</div>
				<div class="er_code">
					<p>
						<img src="/timetravel/Public/Public/image/er_code.png" />
					</p>
					<span>关注微博二维码</span>
				</div>
			</a>
		</div>
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