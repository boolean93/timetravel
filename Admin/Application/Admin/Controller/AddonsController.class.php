<?php
// +----------------------------------------------------------------------
// | OneDream  扩展后台管理页面
// +----------------------------------------------------------------------
// | Copyright (c) 2003-2014 http://www.coolhots.net/ All rights reserved.
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-12
// +----------------------------------------------------------------------
namespace Admin\Controller;

class AddonsController extends AdminController {

    /**
     * 插件列表
     */
    public function index(){
        $this->meta_title = '插件列表';
        $list       =   D('Addons')->getList();
        $list = int_to_string ( $list, array (
        		'status' => array (
        				1 => '已安装',
        				0 => '未安装'
        		)
        ) );
        $request    =   (array)I('request.');
        $total      =   $list? count($list) : 1 ;
        $listRows   =   C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        $page       =   new \Think\Page($total, $listRows, $request);
        $voList     =   array_slice($list, $page->firstRow, $page->listRows);
        $p          =   $page->show();
        $this->assign('list', $voList);
        $this->assign('page', $p? $p: '');
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->display();
    }
    
    /**
     * 插件后台显示页面
     * @param string $name 插件名
     */
    public function adminList($name){
    	// 记录当前列表页的cookie
    	Cookie('__forward__',$_SERVER['REQUEST_URI']);
    	$class = get_addon_class($name);
    	if(!class_exists($class))
    		$this->error('插件不存在');
    	$addon  =   new $class();
    	$this->assign('addon', $addon);
    	$param  =   $addon->admin_list;
    	if(!$param)
    		$this->error('插件列表信息不正确');
    	$this->meta_title = $addon->info['title'];
    	extract($param);
    	$this->assign('title', $addon->info['title']);
    	$this->assign($param);
    	if(!isset($fields))
    		$fields = '*';
    	if(!isset($map))
    		$map = array();
    	if(isset($model))
    		$list = $this->lists(D("Addons://{$model}/{$model}")->field($fields),$map);
    	$this->assign('_list', $list);
    	if($addon->custom_adminlist)
    		//$this->assign('custom_adminlist',json_encode($list_grid));
    		$this->assign('custom_adminlist', $this->fetch($addon->addon_path.$addon->custom_adminlist));
    	$this->display();
    }
    /**
     * 设置插件页面
     */
    public function config(){
    	$id     =   (int)I('id');
    	$addon  =   M('Addons')->find($id);
    	if(!$addon)
    		$this->error('插件未安装');
    	$addon_class = get_addon_class($addon['name']);
    	if(!class_exists($addon_class))
    		trace("插件{$addon['name']}无法实例化,",'ADDONS','ERR');
    	$data  =   new $addon_class;
    	$addon['addon_path'] = $data->addon_path;
    	$addon['custom_config'] = $data->custom_config;
    	$this->meta_title   =   '设置插件-'.$data->info['title'];
    	$db_config = $addon['config'];
    	$addon['config'] = include $data->config_file;
    	if($db_config){
    		$db_config = json_decode($db_config, true);
    		foreach ($addon['config'] as $key => $value) {
    			if($value['type'] != 'group'){
    				$addon['config'][$key]['value'] = $db_config[$key];
    			}else{
    				foreach ($value['options'] as $gourp => $options) {
    					foreach ($options['options'] as $gkey => $value) {
    						$addon['config'][$key]['options'][$gourp]['options'][$gkey]['value'] = $db_config[$gkey];
    					}
    				}
    			}
    		}
    	}
    	$this->assign('data',$addon);
    	if($addon['custom_config'])
    		$this->assign('custom_config', $this->fetch($addon['addon_path'].$addon['custom_config']));
    	$this->meta_title   =  "插件配置 ".$addon['title'];
    	$this->display();
    }
    
    /**
     * 保存插件设置
     */
    public function saveConfig(){
    	$id     =   (int)I('id');
    	$config =   I('config');
    	$flag = M('Addons')->where("id={$id}")->setField('config',json_encode($config));
    	if($flag !== false){
    		$this->success('保存成功', Cookie('__forward__'));
    	}else{
    		$this->error('保存失败');
    	}
    }
    /**
     * 安装插件
     */
    public function install(){
    	$addon_name     =   trim(I('addon_name'));
    	$class          =   get_addon_class($addon_name);
    	if(!class_exists($class))
    		$this->error('插件不存在');
    	$addons  =   new $class;
    	$info = $addons->info;
    	if(!$info || !$addons->checkInfo())//检测信息的正确性
    		$this->error('插件信息缺失');
    	session('addons_install_error',null);
    	$install_flag   =   $addons->install();
    	if(!$install_flag){
    		$this->error('执行插件预安装操作失败'.session('addons_install_error'));
    	}
    	$addonsModel    =   D('Addons');
    	$data           =   $addonsModel->create($info);
    	if(is_array($addons->admin_list) && $addons->admin_list !== array()){
    		$data['has_adminlist'] = 1;
    	}else{
    		$data['has_adminlist'] = 0;
    	}
    	if(!$data)
    		$this->error($addonsModel->getError());
    	if($addonsModel->add($data)){
    		$config         =   array('config'=>json_encode($addons->getConfig()));
    		$addonsModel->where("name='{$addon_name}'")->save($config);
    		$hooks_update   =   D('Hooks')->updateHooks($addon_name);
    		if($hooks_update){
    			S('hooks', null);
    			$this->success('安装成功');
    		}else{
    			$addonsModel->where("name='{$addon_name}'")->delete();
    			$this->error('更新钩子处插件失败,请卸载后尝试重新安装');
    		}
    
    	}else{
    		$this->error('写入插件数据失败');
    	}
    }
    
    /**
     * 卸载插件
     */
    public function uninstall(){
    	$addonsModel    =   M('Addons');
    	$id             =   trim(I('id'));
    	$db_addons      =   $addonsModel->find($id);
    	$class          =   get_addon_class($db_addons['name']);
    	$this->assign('jumpUrl',U('index'));
    	if(!$db_addons || !class_exists($class))
    		$this->error('插件不存在');
    	session('addons_uninstall_error',null);
    	$addons =   new $class;
    	$uninstall_flag =   $addons->uninstall();
    	if(!$uninstall_flag)
    		$this->error('执行插件预卸载操作失败'.session('addons_uninstall_error'));
    	$hooks_update   =   D('Hooks')->removeHooks($db_addons['name']);
    	if($hooks_update === false){
    		$this->error('卸载插件所挂载的钩子数据失败');
    	}
    	S('hooks', null);
    	$delete = $addonsModel->where("name='{$db_addons['name']}'")->delete();
    	if($delete === false){
    		$this->error('卸载插件失败');
    	}else{
    		$this->success('卸载成功');
    	}
    }
    /**
     * 启用插件
     */
    public function enable(){
    	$id     =   I('id');
    	$msg    =   array('success'=>'启用成功', 'error'=>'启用失败');
    	S('hooks', null);
    	$this->resume('Addons', "id={$id}", $msg);
    }
    
    /**
     * 禁用插件
     */
    public function disable(){
    	$id     =   I('id');
    	$msg    =   array('success'=>'禁用成功', 'error'=>'禁用失败');
    	S('hooks', null);
    	$this->forbid('Addons', "id={$id}", $msg);
    }
    
    /**
     * 钩子列表
     */
	public function hooks(){
		$this->meta_title   =   '钩子列表';
		$map    =   $fields =   array();
		$list   =   $this->lists(D("Hooks")->field($fields),$map);
		$list=int_to_string($list, array('type'=>C('HOOKS_TYPE')));
		// 记录当前列表页的cookie
		Cookie('__forward__',$_SERVER['REQUEST_URI']);
		$this->assign('list', $list );
		$this->display();
	}
	//新增钩子
	public function addhook(){
		$this->assign('info', null);
		$this->meta_title = '新增钩子';
		$this->display('addhook');
	}
	
	//钩子编辑
	public function edithook($id){
		$hook = M('Hooks')->field(true)->find($id);
		$this->assign('info',$hook);
		$this->meta_title = '编辑钩子';
		$this->display('addhook');
	}
	
	//超级管理员删除钩子
	public function delhook($id){
		if(M('Hooks')->delete($id) !== false){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	
	/**
	 * 保存
	 */
	public function updateHook(){
		$hookModel  =   D('Hooks');
		$data       =   $hookModel->create();
		if($data){
			if($data['id']){
				$flag = $hookModel->save($data);
				if($flag !== false)
					$this->success('更新成功', Cookie('__forward__'));
				else
					$this->error('更新失败');
			}else{
				$flag = $hookModel->add($data);
				if($flag)
					$this->success('新增成功', Cookie('__forward__'));
				else
					$this->error('新增失败');
			}
		}else{
			$this->error($hookModel->getError());
		}
	}
}