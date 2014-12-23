<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    /**
     *
     */
    public function index(){
        $Slider = M("Slider");
        $Article = M("Article");
        $Route = M("Route");
        $Stuff = M("Stuff");
        $Memory = M("Memory");
        $Taobao = M("Taobao");

        //图片轮播
        $slider = $Slider->order("id DESC")->select();

        //时光之旅
        $time = $Route->where(array("type"=>"time"))->select();
        $time = divideInto($time, 6);

        //极致探险
        $extreme = $Route->where(array("type"=>"extreme"))->select();

        //Young训练营左边的字
        $youngIntro = $Stuff->where(array("title"=>"young"))->find();

        //Young训练营的图片轮播
        $youngImg = $Route
            ->where(array("type"=>"young"))
            ->field("pic_url")
            ->order("id DESC")
            ->limit(5)
            ->select();

        //时光印记
        $memory = $Memory->limit(6)->select();

        //淘宝店绑定
        $taobao = $Taobao->find(1);

        $this->assign("slider", $slider);
        $this->assign("time", $time);
        $this->assign("extreme", $extreme);
        $this->assign("youngImg", $youngImg);
		$this->assign("youngCount", count($youngImg));
        $this->assign("youngIntro", $youngIntro);
        $this->assign("memory", $memory);
        $this->assign("taobao", $taobao);
        $this->display();
    }

    /**
     *  登陆
     */
    public function login(){
    	$data = array(
    		"username" => I("post.username"),
    		"password" => md5( I("post.password").C("PASSWORD_SALT") ),
    	);
    	if(count($res = M("user")->where($data)->select()) == 1){

    		$session = array(
    			"username" => $data["username"],
    			"user_id" => $res[0]['id'],
    		);

    		session("userinfo", $session);

	    	if(I("post.remember") == 'on'){
	    		cookie("username", $data["username"], 3600 * 2);
	    	}else{
                cookie("username",null);
            }
            $this->success('登陆成功');
    	}else{
            $this->error("登陆失败");
        }
    }

    /**
     *  注销
     */
    public function logout(){
    	session("userinfo", null);
        cookie("username", null);
        $this->success("注销成功!");
    }

    public function register(){
        if(IS_POST){
            if(!check_verify(I('post.verify'))){
                $this->error("验证码错误!");
                return ;
            }else{
                $_model = M("User");
                if($_model->create()){
                    $_model->add();
                    $this->success("注册成功!", U("Index/index"));
                }else{
                    $this->error($_model->getError());
                }
            }
        }else{
            $this->display();
        }
    }

    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->entry();
    }
}