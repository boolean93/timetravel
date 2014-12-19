<?php
// +----------------------------------------------------------------------
// | OneDream 后台主页控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.coolhots.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-5
// +----------------------------------------------------------------------
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class IndexController extends AdminController {
	public function index() {
		$userdata = session ( 'user_auth' );
		// roleid 为1是系统管理员，显示所有菜单
		if ($userdata ['roleid'] == 1) {
		}
		else {//其他角色根据权限查询菜单列表
			$ids=implode(',',session('roleauth'));
			if(!$ids) $this->display();//什么权限都没有的情况。
			$map['id']  = array('in',$ids);
			$map['pid'] = 0;
			$map['_logic'] = 'OR';
		}
		$list=D('Auth')->where($map)->order('sort')->select();
		$addons=D('Addons')->getAdminList();
		 foreach ($addons as $value) {
		 	$list[]=array('title'=>$value['title'],'url'=>$value['url'],'pid'=>'21');
		 }
		$list=list_to_tree($list);//转换成Tree
		foreach($list as $key=>$val){//过滤子菜单为空的一级菜单
			if(!$val['_child'])

				unset($list[$key]);
		}
		$this->assign('menu',$list);
		//$this->show(json_encode($list));
		$this->display ();
	}
	public function center() {
		$this->display ();
	}
}