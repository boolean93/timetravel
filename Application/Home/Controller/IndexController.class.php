<?php
namespace Home\Controller;
use Org\QC\QC;
use Think\Controller;

class IndexController extends Controller {

    /**
     *
     */
    public function index(){
        $qc = new QC();

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

        //QQ登陆
        $callback = $qc->qq_callback();
        //判断callback是否合法
        if(mb_substr($callback, 0, 2) != '<h'){
            $openid = $qc->get_openid();
            $access_token = $qc->get_access_token();
//            echo $openid."-".$access_token;
            $userInfo = $qc->get_user_info();
//            $userInfo['nickname'];
            dump($userInfo);
        }


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
    		"password" => myMd5(I("post.password")),
    	);
    	if(count($res = D("User")->where($data)->select()) == 1){

    		$session = array(
    			"username" => $data["username"],
    			"user_id" => $res[0]['id'],
    		);

    		session("userinfo", $session);
            $_data = array(
                "last_login_time"=>time(),
            );

            M("User")->where($data)->save($_data);

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
            if(I("post.agree")!='on'){
                $this->error("请您同意 时光旅行《服务条款》及《隐私权政策》,谢谢");
                return ;
            }
            if(!check_verify(I('post.verify'))){
                $this->error("验证码错误!");
                return ;
            }else{
                $_model = D("User");
                if($_model->create()){
                    if($_model->add()){
                        $this->success("注册成功!", U("Index/index"));
                    }else{
                        $this->error($_model->getError());
                    }
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

    /**
     * @description 基于字符串出现次数排序的Tiny Searching
     * @param $keyword 搜索用的关键字
     */
    public function search(){
        $keyword = I("post.keyword");

        $Memory = M("Memory");
        $Article = M("Article");
        $Route = M("Route");

        $map = array(
            "content"   =>  array("LIKE", "%{$keyword}%"),
            "title"     =>  array("LIKE", "%{$keyword}%"),
            "_logic"    =>  "or",
        );

        $res = array_merge(
            $Memory->where($map)->select(),
            $Article->where($map)->select(),
            $Route->where($map)->select()
        );

        usort($res, array("CompareFunc", $keyword));

        $this->assign("result", $res);
        $this->assign("keyword", $keyword);
        $this->display();
    }

}