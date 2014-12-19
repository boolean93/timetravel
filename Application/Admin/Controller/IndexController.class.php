<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public function _before_index(){
        if(!is_login()){
            $this->error("请登陆!", U("Public/login"));
        }
    }

    public function index(){
        $this->display();
    }

    public function login(){
        $this->display();
    }

    public function loginCheck(){
        $username = I("post.username");
        $password = I("post.password");
        $remember = NULL;
        if(I("post.remeber") == 1) {
            $remember = 1;
        }
        $res = login($username, $password, $remember);
        if($res){
            $this->success("登陆成功!");
        }else{
            $this->error("登录失败, 请检查用户名与密码是否匹配!");
        }
    }

    public function logout(){
        logout();
        $this->success("注销成功!");
    }
}