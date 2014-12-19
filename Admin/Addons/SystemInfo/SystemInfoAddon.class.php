<?php
// +----------------------------------------------------------------------
// | OneDream 系统环境信息插件
// +----------------------------------------------------------------------
// | Copyright (c) 2003-2014 http://www.coolhots.net/ All rights reserved.
// +----------------------------------------------------------------------
// | Author: CoolHots <ChasterChen@gmail.com>
// +----------------------------------------------------------------------
// | Date: 2014-5-3
// +----------------------------------------------------------------------
namespace Addons\SystemInfo;
use Common\Controller\Addon;
use Think\Model;
 class SystemInfoAddon extends Addon{

        public $info = array(
            'name'=>'SystemInfo',
            'title'=>'系统环境信息',
            'description'=>'用于显示一些服务器的信息',
            'status'=>1,
            'author'=>'CoolHots',
            'version'=>'0.1'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

        //实现的AdminIndex钩子方法
        public function AdminIndex($param){
        	$config=$this->GetConfig();
      // 实例化一个model对象 没有对应任何数据表
		$Model = new Model ();
		$mysqlversion = $Model->query ( " select version() AS version" );
		$data ['version'] = C ( 'version' );
		$data ['systemname'] = C ( 'systemname' );
		$data ['updatetime'] = C ( 'updatetime' );
		$data ['php_version'] = PHP_VERSION;
		$data ['uploadDirectory'] = 'Public/upload';
		$data ['mysql'] = $mysqlversion [0] ['version'];
		$this->assign ( 'sysdata', $data );
            if($config['display']){
                $this->display('widget');
            }
        }
    }