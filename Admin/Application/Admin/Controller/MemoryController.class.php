<?php
// +----------------------------------------------------------------------
// | OneDream 内容管理控制器
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

class MemoryController extends AdminController {
	/**
	 * 内容列表
	 */
	public function index() {
		// 生成查询条件
		if (I ( 'cid' )) {
			$map ['cid'] = I ( 'cid' );
		}
		if (I ( 'title' )) {
			$map ['title'] = array (
					'like',
					'%' . I ( 'title' ) . '%' 
			);
		}
		// 获取列表
		$list = $this->lists ( 'Memory', $map, 'id' );
		$this->assign ( 'list', $list );
		$this->assign ( 'map', $map );
		$this->assign ( 'meta_title', '内容列表' );
		// 记录当前列表页的cookie
		Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] );
		$this->display ();
	}
	/**
	 * 添加内容
	 */
	public function add() {
		if (IS_POST) {
			$Memory = D ( 'Memory' );
			$data = $Memory->create ();
            $Memory->create_time = time();
			//$this->error (json_encode($data));
			if ($data) {
				$id = $Memory->add ();
				if ($id) {
					// 记录行为
					action_log ( 'add_Memory', 'Memory', $id, UID );
					$this->success ( '新增成功', U ( 'index' ) );
				} else {
					$this->error ( '新增失败' );
				}
			} else {
				$this->error ( $Memory->getError () );
			}
		} else {
//			$category = M ( 'Category' )->field ( true )->select ();
//			$category = D ( 'Common/Tree' )->toFormatTree ( $category, $title = 'title', $pk = 'cid', $pid = 'pid', $root = 0 );
//			$this->assign ( 'category', $category );
			$this->meta_title = '新增内容';
			$this->assign ( 'info', null );

			$this->display ();
		}
	}
	
	/**
	 * 编辑内容
	 */
	public function edit($id = 0) {
		if (IS_POST) {
			$Memory = D ( 'Memory' );
			$data = $Memory->create ();
			if ($data) {
				if ($Memory->save ()) {
					// 记录行为
					action_log ( 'edit_Memory', 'Memory', $data ['id'], UID );
					$this->success ( '更新成功', Cookie ( '__forward__' ) );
				} else {
					$this->error ( '更新失败' );
				}
			} else {
				$this->error ( $Memory->getError () );
			}
		} else {
			$info = array ();
			/* 获取数据 */
			$info = M ( 'Memory' )->field ( true )->find ( $id );
			
			if (false === $info) {
				$this->error ( '获取配置信息错误' );
			}
			$category = M ( 'Category' )->field ( true )->select ();
			$category = D ( 'Common/Tree' )->toFormatTree ( $category, $title = 'title', $pk = 'cid', $pid = 'pid', $root = 0 );
			$this->assign ( 'category', $category );
			$this->assign ( 'info', $info );
			$this->meta_title = '编辑内容';
			$this->display ();
		}
	}
	
	/**
	 * 删除内容
	 */
	public function delete() {
		$id = array_unique ( ( array ) I ( 'id', 0 ) );
		
		if (empty ( $id )) {
			$this->error ( '请选择要操作的数据!' );
		}
		
		$map = array (
				'id' => array (
						'in',
						$id 
				) 
		);
		if (M ( 'Memory' )->where ( $map )->delete ()) {
			// 记录行为
			action_log ( 'delete_memory', 'Memory', $id, UID );
			$this->success ( '删除成功' );
		} else {
			$this->error ( '删除失败！' );
		}
	}

    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }

    /**
     * @param $id
     * 用于审核
     */
    public function pass($id, $readable){
        if($id > 0){
            $data = array(
                "id"    =>  $id,
                "readable"    =>  $readable,
            );
            if(D("Memory")->save($data)){
                action_log('pass_memory', 'Memory', $id, UID);
                $this->success("修改成功");
            }else{
                $this->error("修改失败");
            }
        }else{
            $this->error("参数错误");
        }
    }
}