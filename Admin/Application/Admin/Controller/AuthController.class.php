<?php 
// +----------------------------------------------------------------------
// | OneDream 规则管理控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.coolhots.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-21
// +----------------------------------------------------------------------
namespace Admin\Controller;

use Think\Controller;

class AuthController extends AdminController {

	/**
	 * 规则列表
	 */
	public function index(){
		$list = D ( 'Auth' )->select ();
		$list = int_to_string ( $list, array (
				'hide' => array (
						1 => '隐藏',
						0 => '显示'
				)
		) );
		$list = D ( 'Common/Tree' )->toFormatTree ( $list);
		$this->assign ( 'list', $list );
		$this->assign ( 'meta_title', '规则列表' );
		// 记录当前列表页的cookie
		Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] );
		$this->display ();
	}
	
	/**
	 * 添加规则
	 */
	public function add(){
		if (IS_POST) {
			$Auth= D ( 'Auth' );
			$data = $Auth->create ();
			if ($data) {
				$id = $Auth->add ();
				if ($id) {
					// 记录行为
					action_log ( 'add_auth', 'Auth', $id, UID );
					$this->success ( '新增成功', U ( 'index' ) );
				} else {
					$this->error ( '新增失败' );
				}
			} else {
				$this->error ( $Auth->getError () );
			}
		} else {
			$auth = M ( 'Auth' )->field ( true )->select ();
			$auth = D ( 'Common/Tree' )->toFormatTree ( $auth);
			$this->assign ( 'auth', $auth );
			$this->meta_title = '新增规则';
			$this->assign ( 'info', null );
			$this->display ();
		}
	}
	
	/**
	 * 编辑规则
	 */
	public function edit($id = 0) {
		if (IS_POST) {
			$Auth = D ( 'Auth' );
			$data = $Auth->create ();
			if ($data) {
				if ($Auth->save ()) {
					// 记录行为
					action_log ( 'edit_auth', 'Auth', $data ['id'], UID );
					$this->success ( '更新成功', Cookie ( '__forward__' ) );
				} else {
					$this->error ( '更新失败' );
					
				}
			} else {
				$this->error ( $Auth->getError () );
			}
		} else {
			$info = array ();
			/* 获取数据 */
			$info = M ( 'Auth' )->field ( true )->find ( $id );
				
			if (false === $info) {
				$this->error ( '获取规则信息错误' );
			}
			$auth = M ( 'Auth' )->field ( true )->select ();
			$auth = D ( 'Common/Tree' )->toFormatTree ( $auth);
			$this->assign ( 'auth', $auth );
			$this->assign ( 'info', $info );
			$this->meta_title = '编辑规则';
			$this->display ();
		}
	}
	
	/**
	 * 删除规则
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
		if (M ( 'Auth' )->where ( $map )->delete ()) {
			// 记录行为
			action_log ( 'delete_auth', 'Auth', $id, UID );
			$this->success ( '删除成功' );
		} else {
			$this->error ( '删除失败！' );
		}
	}

}