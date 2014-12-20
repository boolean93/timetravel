<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>时光之旅</title>
    <link href="/timetravel/Public/css/common.css" rel="stylesheet" type="text/css" />
    <link href="/timetravel/Public/css/memory.css" rel="stylesheet" type="text/css" />

    <script src="/timetravel/Public/js/jquery-2.0.2.js"></script>
    <script src="/timetravel/Public/ueditor/ueditor.config.js" ></script>
    <script src="/timetravel/Public/ueditor/ueditor.all.min.js" ></script>


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
	<div id="m_content">
		<h4>精彩游记</h4>
		<?php if(is_array($article)): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="m_list">
                <a href="<?php echo U('Home/Memory/detail', array('id'=>$vo['id']));?>">
                    <img class="m_pic" src="<?php echo ($vo["pic_url"]); ?>" />
                </a>

                <div class="m_title">
                    <img src="/timetravel/Public/image/d_look.png" />
                    <a href="<?php echo U('Memory/detail', array('id'=>$vo['id']));?>">
                        <span class="s_title"><?php echo ($vo["title"]); ?></span>
                    </a>
                    <span>
                        作者：<?php echo (getusernamebyuserid($vo["user_id"])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (date("Y-m-d",$vo["create_time"])); ?>
                        <a class="c_f" href="#"><?php echo ($vo["click"]); ?></a>
                        <a class="c_s" href="#"><?php echo ($vo["good"]); ?></a>
                    </span>
                </div>

                <p><?php echo (mb_substr(strip_tags(htmlspecialchars_decode($vo["content"])),0,120)); ?>
                    <a href="<?php echo U('Home/Memory/detail', array('id'=>$vo['id']));?>">查看全文</a>
                </p>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <p class="page">
            <a href="#">上一页</a>
            <?php if(is_array($page)): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo != '...'): ?><a <?php if($vo == $pid): ?>class="t_active"<?php endif; ?> href="<?php echo U('Home/Memory/index', array('pid' => $vo));?>"><?php echo ($vo); ?></a>
                <?php else: ?>
                    <a href="#">...</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <a href="#">下一页</a>

        </p>

        <form action="<?php echo U('Home/Memory/submit');?>" method="post" style="margin-top:20px">
            <label for="title">标题:</label><br/>
            <input type="text" name="title" id="title" style="
                font-size:16px;
                padding:8px;
                width:400px;
                border:1px solid grey;
                border-radius: 2px;
                margin-top:20px"/>
            <br/><br/>
            <label for="pic_url">封面图片地址:</label><br/>
            <input type="text" name="pic_url" id="pic_url" style="
                font-size:16px;
                padding:8px;
                width:400px;
                border:1px solid grey;
                border-radius: 2px;
                margin-top:20px"/>

            <div style="margin-top:20px">
                <textarea name="content" id="myEditor"></textarea>
            </div>

            <script>
                $(function(){
                    var ue = UE.getEditor('myEditor',{
                        serverUrl :'<?php echo U("Home/Memory/ueditor");?>'
                    });
                })
            </script>

            <input type="submit" value="撰写游记" class="write"/>
        </form>
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