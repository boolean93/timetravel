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
        //整理时间格式
        for($i = 0; $i < count($older); $i++ ){
            $year = date('Y', $older[$i]['end_time']);
            $temp[$year][] = $older[$i];
        }

        //将数据分组并把年份分离开
        foreach($temp as $k => $v){
            $res[$k] = divideInto($v, 4);
            $resYear[] = $k;
        }

        //翻转数组, 因为js实现的时候是反着的T_T
        foreach($res as $k => $v){
            $res[$k] = array_reverse($res[$k]);
        }

        //倒序结果
        $res = array_reverse($res);
        $resYear = array_reverse($resYear);

        $this->assign("older", $res);
        $this->assign("year", $resYear);
        $this->assign("latest", $latest);

        $this->display();
        dump($res);

    }
}