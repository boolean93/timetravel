<?php
// +----------------------------------------------------------------------
// | OneDream 初始化钩子信息
// +----------------------------------------------------------------------
// | Copyright (c) 2003-2014 http://www.coolhots.net/ All rights reserved.
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-1
// +----------------------------------------------------------------------
namespace Common\Behavior;
use Think\Behavior;
use Think\Hook;
defined('THINK_PATH') or exit();
class InitHookBehavior extends Behavior {
	// 行为扩展的执行入口必须是run
	public function run(&$content){
		if(isset($_GET['m']) && $_GET['m'] === 'Install') return;
	
		$data = S('hooks');
		if(!$data){
			$hooks = M('Hooks')->getField('name,addons');
			foreach ($hooks as $key => $value) {
				if($value){
					$map['status']  =   1;
					$names          =   explode(',',$value);
					$map['name']    =   array('IN',$names);
					$data = M('Addons')->where($map)->getField('id,name');
					if($data){
						$addons = array_intersect($names, $data);
						Hook::add($key,$addons);
					}
				}
			}
			S('hooks',Hook::get());
		}else{
			Hook::import($data,false);
		}
	}
}