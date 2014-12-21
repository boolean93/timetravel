<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>注册</title>
    <link href="/timetravel/Public/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="/timetravel/Public/css/register.css" rel="stylesheet" type="text/css"/>
    <script src="/timetravel/Public/js/form.js" type="text/javascript"></script>
    <script>
        window.onload = function () {
            form_check();
            login_box();
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
<div id="r_box">
    <h4>创建您的新用户</h4>

    <div class="r_form">
        <p class="r_title">创建账户<span class="r_right"><b>或者</b><a href="#">登陆</a></span></p>

        <form action="#" method="post">

            <span>注册邮箱<b class="config_email"></b></span>

            <p>
                <input class="r_email" type="text" name="username"/>
            </p>
            <span>登陆密码<b class="config_psw"></b></span>

            <p>
                <input class="r_psw" type="password" name="password"/>
            </p>

            <span>重复密码<b class="config_repsw"></b></span>

            <p>
                <input class="r_repsw" type="password" name="repassword"/>
            </p>

            <p class="again">为必填项</p>
            <span class="no_sign">联系手机<b class="config_phone"></b></span>

            <p>
                <input class="r_phone" type="text" name="tel"/>
            </p>
            <span class="code">验证码<b></b></span>

            <p>
                <input class="code_box" type="text" name="verify"/><span class="code_pic">验证码图片</span>
            </p>

            <p class="f_agree"><input class="agree" type="checkbox">我同意 时光旅行《服务条款》及《隐私权政策》</p>

            <p>
                <input class="f_go" type="submit" value="注 册">
            </p>
        </form>
    </div>
</div>
<div id="footer">
    <div id="f_content">
        <div id="f_left">
            <img class="f_logo" src="/timetravel/Public/image/logo.png"/>
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
                <a href="#"><img src="/timetravel/Public/image/f_web.png"/></a>
                <a href="#"><img src="/timetravel/Public/image/f_qq.png"/></a>
            </p>
        </div>
        <div id="f_right">
            <img src="/timetravel/Public/image/erw.png"/>
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
</body>
</html>