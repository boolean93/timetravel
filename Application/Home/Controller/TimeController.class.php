<?php
namespace Home\Controller;

use Think\Controller;

class TimeController extends BaseController
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

    public function detail($id){
        $Article = M("Article");

        $Article->where("id=$id")->setInc("click");

        $res = $Article->find($id);
        if(count($res) > 0){
            $this->assign("article", $res);
            $this->display("detail");
        }else{
            $this->error("您可能进入了一个无人区啊喵0.0");
        }
//        dump($res);
    }

    public function good($id){
        M("Article")->where("id=$id")->setInc("good");
        $this->redirect(U("Home/Time/detail",array("id"=>$id)));
    }
}
