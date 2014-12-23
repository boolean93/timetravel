<?php
// +----------------------------------------------------------------------
// | OneDream 后台公共文件,主要定义后台公共函数库
// +----------------------------------------------------------------------
// | Copyright (c) 2003-2014 http://www.coolhots.net/ All rights reserved.
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-8
// +----------------------------------------------------------------------

/**
 * select返回的数组进行整数映射转换
 *
 * @param array $map
 *        	映射关系二维数组 array(
 *        	'字段名1'=>array(映射关系数组),
 *        	'字段名2'=>array(映射关系数组),
 *        	......
 *        	)
 * @return array array(
 *         array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *         ....
 *         )
 *        
 */
function int_to_string($data, $map = array('status'=>array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿'))) {
	if ($data === false || $data === null) {
		return $data;
	}
	$data = ( array ) $data;
	foreach ( $data as $key => $row ) {
		foreach ( $map as $col => $pair ) {
			if (isset ( $row [$col] ) && isset ( $pair [$row [$col]] )) {
				$data [$key] [$col . '_text'] = $pair [$row [$col]];
			}
		}
	}
	return $data;
}

/**
 * *根据pid获取菜单标题
 */
function getMenuTitleByPid($pid) {
	$data = M ( 'menu' )->where ( 'id=' . $pid )->find ();
	if ($data) {
		return $data ['title'];
	} else {
		return '无';
	}
}
/**
 * 获取对应状态的文字信息
 *
 * @param int $status        	
 * @return string 状态文字 ，false 未获取到
 */
function get_status_title($status = null) {
	if (! isset ( $status )) {
		return false;
	}
	switch ($status) {
		case - 1 :
			return '已删除';
			break;
		case 0 :
			return '禁用';
			break;
		case 1 :
			return '正常';
			break;
		case 2 :
			return '待审核';
			break;
		default :
			return false;
			break;
	}
}

/**
 * 获取数据的状态操作
 */
function show_status_op($status) {
	switch ($status) {
		case 0 :
			return '启用';
			break;
		case 1 :
			return '禁用';
			break;
		case 2 :
			return '审核';
			break;
		default :
			return false;
			break;
	}
}

/**
 * 获取行为数据
 *
 * @param string $id
 *        	行为id
 * @param string $field
 *        	需要获取的字段
 */
function get_action($id = null, $field = null) {
	if (empty ( $id ) && ! is_numeric ( $id )) {
		return false;
	}
	$list = S ( 'action_list' );
	if (empty ( $list [$id] )) {
		$map = array (
				'status' => array (
						'gt',
						- 1 
				),
				'id' => $id 
		);
		$list [$id] = M ( 'Action' )->where ( $map )->field ( true )->find ();
	}
	return empty ( $field ) ? $list [$id] : $list [$id] [$field];
}
/**
 * 根据栏目编号获取栏目名称
 */
function get_categoryName($id = null) {
	if (empty ( $id )) {
		return '';
	}
	$info = M ( 'Category' )->field ( 'title' )->find ( $id );
	if ($info) {
		return $info['title'];
	} else {
		return '';
	}
}

/**
 * @param $status 0 or 1
 * @return string
 */
function get_my_status_title($status){
    $data = array(
        "0" =>  '正常',
        "1" =>  '禁用',
    );
    return $data[$status];
}

/**
 * @param $readable 0 or 1
 * @return string
 */
function get_my_readable_title($readable){
    $data = array(
        "0" =>  '未审核',
        "1" =>  '审核通过',
    );
    return $data[$readable];
}

function getArticleTitleById($id){
    $res = D("Article")->field("title")->find($id);
    return $res['title'];
}

function getRouteTitleById($id){
    $res = D("Route")->field("title")->find($id);
    return $res['title'];
}

function getMemoryPreviewUrl($id){
	$res = explode('Admin', __ROOT__);
	$res = $res[0]."index.php?m=home&c=memory&a=preview&id=$id";
	return $res;
}

/**
 * 获取网站地址
 */
function getIndexUrl(){
	$res = explode('Admin', __ROOT__);
	return $res[0];
}