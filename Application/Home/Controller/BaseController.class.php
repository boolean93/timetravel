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
        $ercode = M("Ercode")->find(1);
        $contact = M("Contact")->find(1);

        $this->assign('taobao', $taobao);

        $this->assign('er1', $ercode['url1']);
        $this->assign('er2', $ercode['url2']);

        $this->assign("qq", $contact["qq"]);
        $this->assign("tel", $contact["tel"]);
    }
}