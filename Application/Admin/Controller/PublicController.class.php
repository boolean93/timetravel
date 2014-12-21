<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {

    public function _initialize(){
        if(is_login()){
            $this->redirect(U("Index/index"));
        }
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
        if($res === true){
            $this->success("登陆成功!", U("Index/index"));
        }else{
            $this->error($res, U("Public/login"), 1);
        }
    }

    public function logout(){
        logout();
        $this->success("注销成功!");
    }

    public function verify(){
        $verify = new \Think\Verify();
        $verify->entry(1);
    }
}