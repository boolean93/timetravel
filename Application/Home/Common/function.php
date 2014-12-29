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
        return ($attribute == 'U')? '#' : '无';
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
    if(is_numeric($pid)){
        if($pid > 1){
            $pid--;
        }
    }else{
        $pid = 1;
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
function nextPageUrl($model, int $url,
                     $pid, $pidTable='pid',
                     $condition=null)
{
    if($condition)
        $pageSum = (int)ceil(M($model)->where($condition)->count() / C("ARTICLE_PER_PAGE"));
    else
        $pageSum = (int)ceil(M($model)->count() / C("ARTICLE_PER_PAGE"));

    if($pid > 0){
        if ($pid < $pageSum) {
            $pid++;
        }
    }else{
        $pid = 1;
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
    return ($min == 100000)? "暂无" : $min." 元起";
}

function check_verify($code, $id = ''){
$verify = new \Think\Verify();
return $verify->check($code, $id);
}

function checkPwd($password){
    if(strlen($password) < 6){
        return false;
    }
    if(strlen($password) > 15){
        return false;
    }
    return true;
}

function CompareFunc($keyword){
    return function($a, $b) use ($keyword){
        return CompareFuncForSearch($a, $b, $keyword);
    };
}

function CompareFuncForSearch($a, $b, $keyword){
    $sumA = 0;
    $sumB = 0;
    $sumA += mb_substr_count($a['title'], $keyword);
    $sumA += mb_substr_count($a['content'], $keyword);
    $sumB += mb_substr_count($b['title'], $keyword);
    $sumB += mb_substr_count($b['content'], $keyword);
    return ($sumA > $sumB)? -1 : 1;
}

function getImgUrl($obj){
    if($obj['img_url']){
        return $obj['img_url'];
    }
    if($obj['header_img']){
        return $obj['header_img'];
    }
    if($obj['pic_url']){
        return $obj['pic_url'];
    }
}

function myMd5($pwd){
    return (md5( I("post.password").C("PASSWORD_SALT") ));
}

function do_post($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_URL, $url);
    $ret = curl_exec($ch);

    curl_close($ch);
    return $ret;
}

function get_url_contents($url)
{
    if (ini_get("allow_url_fopen") == "1")
        return file_get_contents($url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result =  curl_exec($ch);
    curl_close($ch);

    return $result;
}

/**
 * @description 服务器的file_get_contents有问题, 不能抓https, 故用此替代
 * @param $url
 * @param int $timeout
 * @param array $header
 * @return mixed
 * @throws Exception
 */
function http_request($url,$timeout=30,$header=array()){
    if (!function_exists('curl_init')) {
        throw new Exception('server not install curl');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    if (!empty($header)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    $data = curl_exec($ch);
    list($header, $data) = explode("\r\n\r\n", $data);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code == 301 || $http_code == 302) {
        $matches = array();
        preg_match('/Location:(.*?)\n/', $header, $matches);
        $url = trim(array_pop($matches));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
    }

    if ($data == false) {
        curl_close($ch);
    }
    @curl_close($ch);
    return $data;
}


/**
 * @description 粗略判断是否是QQ登陆的回调链接.
 * @return bool
 */
function checkIsQQCallback(){
    $state = I("get.state");
    $code = I("get.code");
    if(strlen($state) < 8 || strlen($code) < 8){
        return false;
    }
    return true;
}