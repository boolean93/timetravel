<?php
namespace Home\Controller;
use Think\Controller;
class YoungController extends BaseController {
    public function index()
    {
        $latest = M("Route")
            ->where(array('type' => "young"))
            ->where( array("end_time" => array( "gt", time() )) )
            ->order("end_time desc")
            ->select();

        $older = M("Route")
            ->where(array('type' => "young"))
            ->where( array("end_time" => array( "lt", time() )) )
            ->select();

        $temp = array();
        $res = array();
        for($i = 0; $i < count($older); $i++ ){
            $year = date('Y', $older[$i]['end_time']);
            $temp[$year][] = $older[$i];
        }

        foreach($temp as $k => $v){
            $res[$k] = divideInto($v, 4);
        }

        foreach($res as $k => $v){
            $res[$k] = array_reverse($res[$k]);
        }

//        dump($res);
        $res = array_reverse($res);

        $this->assign("older", $res);
        $this->assign("latest", $latest);

        $this->display();
    }
}