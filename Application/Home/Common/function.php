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
    else return '暂无0.0';
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
        if($i % $singleSum == 0){
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

function getUserName(){
    if(cookie('username')){
        return cookie('username');
    }
    if($_session = session('userinfo')){
//        dump($_session);
        return $_session['username'];
    }
}

/**
 * @description 获取上一页
 * @param $module_name
 * @param $id
 * @param $attribute
 * @return string
 */
function getLast($module_name, $id, $attribute){
    $_module = M($module_name);
    if($id > 1) {
        $id--;
    }else{
        return ($attribute == 'U')?'#':' 无 ';
    }
    if($attribute == 'U')
        return U($module_name."/detail", array("id"=>$id));
    else{
        $res = $_module->field($attribute)->find($id);
        return $res[$attribute];
    }
}

/**
 * @description 获取下一页
 * @param $module_name 模型名
 * @param $id
 * @param $attribute U就是U函数, 否则就是字段
 * @return string
 */
function getNext($module_name, $id, $attribute){
    $_module = M($module_name);
    $temp = $_module->order('id DESC')->find();
    if($id < $temp['id']){
        $id++;
    }else{
        return ($attribute == 'U')?'#':' 无 ';
    }
    if($attribute == 'U')
        return U($module_name."/detail", array("id"=>$id));
    else{
        $res = $_module->field($attribute)->find($id);
        return $res[$attribute];
    }
}

/**
 * @param $model
 * @param $url
 * @param $pid
 * @param $pidTable
 * @return string
 */
function lastPageUrl($model, $url,
                     $pid, $pidTable='pid'){
    if($pid > 1){
        $pid--;
    }
    return U($url, array($pidTable => $pid));
}

/**
 * @param $model
 * @param $url
 * @param $pid
 * @param string $pidTable
 * @param null $condition
 * @return string
 */
function nextPageUrl($model, $url,
                     $pid, $pidTable='pid',
                     $condition=null)
{
    $pageSum = ceil(M($model)->where($condition)->count() / C("ARTICLE_PER_PAGE"));
    if ($pid < $pageSum) {
        $pid++;
    }
    return U($url, array($pidTable => $pid));
}

function getPriceByRouteId($id){
    $price = M("Price")
        ->where(array("route_id"=>$id))
        ->select();
    $min = 100000;
    foreach($price as $v){
        if($v['price'] < $min) $min = $v['price'];
    }
    return ($min == 100000)?"暂无":$min;
}