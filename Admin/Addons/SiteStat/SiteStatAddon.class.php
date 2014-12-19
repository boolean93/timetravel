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
namespace Addons\SiteStat;
use Common\Controller\Addon;
class SiteStatAddon extends Addon{

    public $info = array(
        'name'=>'SiteStat',
        'title'=>'站点统计信息',
        'description'=>'统计站点的基础信息',
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
        $config = $this->getConfig();
        $this->assign('addons_config', $config);
        if($config['display']){
            $info['user']		=	M('Member')->count();
            $info['action']		=	M('ActionLog')->count();
            $info['article']	=	M('Article')->count();
            $info['category']	=	M('Category')->count();
            $this->assign('info',$info);
            if($config['display']){
            	$this->display('info');
            }
        }
    }
}