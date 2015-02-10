<?php
namespace Home\Controller;
use Think\Controller;
class ExploreController extends BaseController {
    public function index()
    {
        $Stuff = M("Stuff");
        $Route = M("Route");
        $Article = M("Article");

        $extreme_1 = $Stuff->where(array("other"=> "extreme_1"))->find();
        $extreme_2 = $Stuff->where(array("other"=> "extreme_2"))->find();

        $activity = $Route->order("id DESC")->limit(6)->select();

        $leader = $Article
            ->order("id DESC")
            ->where(array("type"=>"leader"))
            ->limit(6)
            ->field("header_img, id")
            ->select();

        $this->assign("stuff", array($extreme_1, $extreme_2));
        $this->assign("activity", $activity);
        $this->assign("leader", $leader);

        $this->display();
    }

    public function leader($id){
        $this->assign('article', M("Article")->find($id));
        $this->display('Time/detail');
    }
}