<?php
/**
 * Created by PhpStorm.
 * User: Boolean93
 * Date: 14/11/11
 * Time: 15:13
 */

/**
 * @description 密码加密方式
 * @param $password
 * @return string
 */
function getPassword($password){
    return md5($password.C("PASSWORD_SALT"));
}

/**
 * @description 用于判断是否登陆
 * @return bool
 */
function is_login(){
    if (session("user_id") > 0 || cookie("user_id") > 0) {
        return true;
    }
    return false;
}

/**
 * @description 用于登陆
 * @param $username
 * @param $password
 * @param $remember
 * @return bool
 */
function login($username, $password, $remember=NULL){
    $verify = I("post.verify");
    if(!check_verify($verify)){
        return "验证码输入错误";
    }
    $user = M("Admin")->where(array("username" => $username))->find();
    if($user['password'] == getPassword($password)){
        session("username", $username);
        session("user_id", $user['id']);
        if($remember){
            cookie("user_id", $user['id'], 3600 * 2);
        }
        return true;
    }else{
        return "用户名与密码不匹配";
    }
}

/**
 *  @description 注销
 */
function logout(){
    session("username", null);
    session("user_id", null);
    cookie("username", null);
}

/**
 * @description 分页函数
 * @param $pid
 * @param $model
 * @param $condition
 * @return mixed
 */
function page($pid, $model, $condition){

    $count = $model
        ->where($condition)
        ->count();

    $pageSum = ceil($count / C("ARTICLE_PER_PAGE"));
    if(!in_array($pid, range(1, $pageSum))){
        $pid = 1;
    }

    $pageArray = range(1, $pageSum);
    if($pageSum - $pid > 2){
        for($i = $pid + 2; $i < $pageSum; $i++){
            array_pop($pageArray);
        }
        $pageArray[] = "...";
        $pageArray[] = $pageSum;
    }

    if($pid - 1 > 2){
        $offset = $pid - 2;
        $pageArray = array_slice($pageArray, $offset);
        $pageArray = array_merge(array(1, '...'), $pageArray);
    }

    $res['limit'] = C("ARTICLE_PER_PAGE");
    $res['start'] = ($pid - 1) * $res['limit'];
    $res['pageArray'] = $pageArray;
    return $res;
}

/**
 * @description 验证码
 * @param $code
 * @param int $id
 * @return bool
 */
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * @param $route_id
 * @return mixed
 */
function getRouteTitleById($route_id){
    $r = M("Route")->find($route_id);
    return $r['title'];
}
