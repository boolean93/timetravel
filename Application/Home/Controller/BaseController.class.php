<?php
/**
 * Created by PhpStorm.
 * User: Boolean93
 * Date: 14/12/29
 * Time: 02:23
 */

namespace Home\Controller;
use Think\Controller;


class BaseController extends Controller{
    public function _initialize(){
        //淘宝店绑定
        $taobao = M("Taobao")->find(1);
        $this->assign('taobao', $taobao);
    }
}