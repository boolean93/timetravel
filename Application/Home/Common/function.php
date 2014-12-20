<?php
/**
 * Created by PhpStorm.
 * User: Boolean93
 * Date: 14/11/11
 * Time: 15:13
 */

/**
 * @description 用于判断是否登陆
 * @return bool
 */
function is_login(){
    if(count(session("userinfo")) > 0
        ||  cookie("username")) {
        return true;
    }
    return false;
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
 * @description 通过Route.id找到其最低的价格
 * @param $id
 * @return mixed
 */
function getLowestPriceByRouteId($id){
    if($result = M("Price")->where("route_id = $id")->order("price")->find())
        return $result['price'];
    else return 0;
}

/**
 * @description 把数组按照$singleSum个数进行分组.一维转二维
 * @param $arr
 * @param $singleSum
 * @return array
 */
function divideInto($arr, $singleSum){
    $res = array();
    $tot = 0;
    for($i = 0; $i < count($arr); $i++){
        if($i % $singleSum = 0){
            $tot++;
        }
        $res[$tot][$i % $singleSum] = $arr[$i];
    }
    return $res;
}

/**
 * @description 通过用户id获取其用户名
 * @param $id
 * @return mixed
 */
function getUsernameByUserId($id){
    $res = M('User')->find($id);
    return $res['username'];
}