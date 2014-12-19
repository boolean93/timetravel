<?php
// +----------------------------------------------------------------------
// | OneDream 配置管理控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.coolhots.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-7
// +----------------------------------------------------------------------
namespace Admin\Controller;

use Think;
use Think\Controller;

class ConfigController extends AdminController {
	/**
	*配置管理主页
	*/
	public function index(){
		/* 查询条件初始化 */
		$map = array ();
		$list = $this->lists ( 'Config', $map, 'id' );
		// 记录当前列表页的cookie
		Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] );
		 $this->assign ( 'list', $list );
		 $this->assign('meta_title','配置管理');
		 $this->display ();
	}

	    /**
     * 新增配置
     */
    public function add(){
        if(IS_POST){
            $Config = D('Config');
            $data = $Config->create();
            if($data){
            	$id=$Config->add();
                if($id){
                    S('DB_CONFIG_DATA',null);
                    // 记录行为
                    action_log ( 'add_config', 'Config', $id, UID );
                    $this->success('新增成功', U('index'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Config->getError());
            }
        } else {
            $this->meta_title = '新增配置';
            $this->assign('info',null);
            $this->display();
        }
    }

        /**
     * 编辑配置
     */
    public function edit($id = 0){
        if(IS_POST){
            $Config = D('Config');
            $data = $Config->create();
            if($data){
                if($Config->save()){
                    S('DB_CONFIG_DATA',null);
                    // 记录行为
                    action_log ( 'edit_config', 'Config', $data['id'], UID );
                    $this->success('更新成功', Cookie('__forward__'));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($Config->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Config')->field(true)->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑配置';
            $this->display();
        }
    }

     /**
     * 删除配置
     */
    public function delete(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Config')->where($map)->delete()){
        	// 记录行为
        	action_log ( 'delete_config', 'Config', $id, UID );
            S('DB_CONFIG_DATA',null);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}