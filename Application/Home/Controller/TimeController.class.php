<?php
namespace Home\Controller;

use Think\Controller;

class TimeController extends Controller
{

    public function index($pid = 1)
    {
        $info = page($pid, D("Article"),"article.type = 'time'");

        $Time = D("Article");
        $list = $Time
            ->relation(true)
            ->where(array("article.type" => "time"))
            ->limit("$info[start], $info[limit]")
            ->select();

//        dump($list);

        $this->assign("page", $info['pageArray']);
        $this->assign("pid", $pid);
        $this->assign("list", $list);

        $this->display();
    }
}
