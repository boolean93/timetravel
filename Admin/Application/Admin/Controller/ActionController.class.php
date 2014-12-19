<?php
// +----------------------------------------------------------------------
// | OneDream 行为管理控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2003-2014 http://www.coolhots.net/ All rights reserved.
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-12
// +----------------------------------------------------------------------
namespace Admin\Controller;

use Think\Controller;

class ActionController extends AdminController {
	/**
	 * 用户行为列表
	 */
	public function index() {
		// 获取列表数据
		$Action = M ( 'Action' )->where ( array (
				'status' => array (
						'gt',
						- 1 
				) 
		) );
		$list = $this->lists ( $Action );
		$list = int_to_string ( $list, array (
				'status' => array (
						1 => '启用',
						0 => '禁用' 
				) 
		) );
		// 记录当前列表页的cookie
		Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] );
		
		$this->assign ( 'list', $list );
		$this->meta_title = '用户行为';
		$this->display ();
	}
	
	/**
	 * 新增行为
	 */
	public function addAction() {
		if (IS_POST) {
			$action = D ( 'Action' );
			$data = $action->create ();
			if ($data) {
				$id = $action->add ();
				if ($id) {
					// 记录行为
					action_log ( 'change_log', 'Action', $id, UID );
					$this->success ( '更新成功', Cookie ( '__forward__' ) );
				} else {
					$this->error ( '更新失败' );
				}
			} else {
				$this->error ( $action->getError () );
			}
		} else {
			$this->meta_title = '新增行为';
			$this->assign ( 'info', null );
			$this->display ();
		}
	}
	
	/**
	 * 编辑行为
	 */
	public function editAction() {
		IF (IS_POST) {
			$action = D ( 'Action' );
			$data = $action->create ();
			if ($data) {
				if ($action->save ()) {
					// 记录行为
					action_log ( 'change_log', 'Action', $data ['id'], UID );
					$this->success ( '更新成功', Cookie ( '__forward__' ) );
				} else {
					$this->error ( '更新失败' );
				}
			} else {
				$this->error ( $action->getError () );
			}
		} else {
			$id = I ( 'get.id' );
			empty ( $id ) && $this->error ( '参数不能为空！' );
			$info = M ( 'Action' )->field ( true )->find ( $id );
			
			$this->assign ( 'info', $info );
			$this->meta_title = '编辑行为';
			$this->display ();
		}
	}
	
	/**
	 * 删除行为
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
		if (M ( 'Action' )->where ( $map )->delete ()) {
			$this->success ( '删除成功' );
		} else {
			$this->error ( '删除失败！' );
		}
	}
	/**
	 * 行为日志
	 */
	public function log() {
		// 获取列表数据
		$map ['status'] = array (
				'gt',
				- 1 
		);
		$list = $this->lists ( 'ActionLog', $map );
		int_to_string ( $list );
		$this->assign ( 'list', $list );
		$this->meta_title = '行为日志';
		$this->display ();
	}
	/**
	 * 删除行为日志
	 */
	public function deletelog($id) {
		if (empty ( $id )) {
			$this->error ( '参数错误！' );
		}
		$map ['id'] = $id;
		$res = M ( 'ActionLog' )->where ( $map )->delete ();
		if ($res !== false) {
			// 记录行为change_log
			action_log ( 'delete_log', 'ActionLog', $res, UID );
			$this->success ( '删除成功！' );
		} else {
			$this->error ( '删除失败！' );
		}
	}
	/**
	 * 清空日志
	 */
	public function clear() {
		$res = M ( 'ActionLog' )->where ( '1=1' )->delete ();
		if ($res !== false) {
			// 记录行为
			action_log ( 'clear_log', 'ActionLog', $uid, UID );
			$this->success ( '日志清空成功！' );
		} else {
			$this->error ( '日志清空失败！' );
		}
	}
	public function detail() {
		$id = I ( 'get.id' );
		empty ( $id ) && $this->error ( '参数不能为空！' );
		$info = M ( 'ActionLog' )->field ( true )->find ( $id );
		
		$this->assign ( 'info', $info );
		$this->meta_title = '查看行为日志';
		$this->display ();
	}
}