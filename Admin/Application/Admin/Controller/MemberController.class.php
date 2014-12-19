<?php
// +----------------------------------------------------------------------
// | OneDream 用户管理控制器
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

class MemberController extends AdminController {
	
	/**
	 * 用户管理首页
	 */
	public function index() {
		/* 查询条件初始化 */
		$map = array ();
		$map ['status'] = 1;
		$list = $this->lists ( 'member', $map, 'uid' );
		// 记录当前列表页的cookie
		Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] );
		$list = int_to_string ( $list, array (
				'sex' => array (
						1 => '女',
						0 => '男' 
				) 
		) );
		// $this->show ( json_encode ( $list ), 'utf-8' );
		$this->assign ( 'list', $list );
		$this->assign ( 'meta_title', '用户列表' );
		$this->display ();
	}
	/**
	 * 用户授权
	 */
	public function auth() {
		$id = I ( 'uid' );
		if (IS_POST) {
			$authdata = I ( 'auth' );
			$member = D ( 'Member' ); // 实例化Member对象
			$data ['uid'] = $id;
			$data ['auth'] = $authdata;
			// 根据条件更新记录
			if ($member->save ( $data )) {
				$info = D ( 'Member' )->field ( 'roleid' )->find ( $id );
				$member->loadAuth ( $info ['roleid'], $authdata );
				// 记录行为
				action_log ( 'user_auth', 'Member', $id, UID );
				$this->success ( '授权成功', U ( 'index' ) );
			} else {
				$this->error ( '授权失败！' );
			}
		} else {
			$info = D ( 'Member' )->find ( $id );
			$auth_data = explode ( ',', $info ['auth'] );
			$auth_list = D ( 'Auth' )->field ( 'id,title as name,pid as pId' )->select ();
			$auths = array ();
			foreach ( $auth_list as $v => $k ) {
				if (! in_array ( $k ['id'], $auth_data )) {
					$k ['checked'] = false;
				} else {
					$k ['checked'] = true;
				}
				$k ['open'] = true;
				$auths [] = $k;
			}
			
			if ($info) {
				$this->assign ( 'info', $info );
				$this->assign ( 'Auth', json_encode ( $auths ) );
				$this->assign ( 'meta_title', '用户授权' );
				$this->display ();
			} else {
				$this->error ( '获取用户信息失败！' );
			}
		}
	}
	/**
	 * 更新用户
	 */
	public function edit($id = null) {

		$model = D ( 'Member' );
		if (IS_POST) {
			$data = $model->create ();
			if ($data) {
				if ($model->save () !== false) {
					
					
					$pwddata = array();
					if ($data ['password']) {
						$pwddata ['uid'] = $data['uid'];
						$password = get_password ( $data ['password'] );
						$pwddata ['password'] = $password ['password'];
						$pwddata ['encrypt'] = $password ['encrypt'];
						D ( 'Member' )->save ( $pwddata );
					}
					
					// 记录行为
					action_log ( 'update_member', 'Member', $data ['uid'], UID );
					$this->success ( '更新成功', Cookie ( '__forward__' ) );
				} else {
					$this->error ( '更新失败' );
				}
			} else {
				$this->error ( $model->getError () );
			}
		} else {
			$info = $model->field ( true )->find ( $id );
			$role = D ( 'Role' )->field ( 'id,title' )->select ();
			$this->assign ( 'Role', $role );
			$this->assign ( 'info', $info );
			$this->assign ( 'meta_title', '编辑用户' );
			$this->display ();
		}
	}
	
	/**
	 * 新增用户
	 */
	public function add() {
		if (IS_POST) {
			$model = D ( 'Member' );
			$data = $model->create ();
			if ($data) {
				if ($data ['password']) {
					$password = get_password ( $data ['password'] );
					$data ['password'] = $password ['password'];
					$data ['encrypt'] = $password ['encrypt'];
				}
				$id = $model->add ();
				if ($id) {
					
					$pwddata = array();
					if ($data ['password']) {
						$pwddata ['uid'] = $id;
						$password = get_password ( $data ['password'] );
						$pwddata ['password'] = $password ['password'];
						$pwddata ['encrypt'] = $password ['encrypt'];
						D ( 'Member' )->save ( $pwddata );
					}
					// 记录行为
					action_log ( 'add_member', 'Member', $id, UID );
					$this->success ( '添加成功', Cookie ( '__forward__' ) );
				} else {
					$this->error ( '添加失败' );
				}
			} else {
				$this->error ( $model->getError () );
			}
		} else {
			$role = D ( 'Role' )->field ( 'id,title' )->select ();
			$this->assign ( 'Role', $role );
			$this->assign ( 'meta_title', '新增用户' );
			$this->display ();
		}
	}
	/**
	 * 删除用户
	 */
	public function delete($id) {
		if ($id == 1) {
			$this->error ( '超级管理员不能删除', Cookie ( '__forward__' ) );
		}
		if ($id) {
			if (M ( 'member' )->where ( 'uid=' . $id )->delete ()) {
				// 记录行为
				action_log ( 'dlete_member', 'Member', $id, UID );
				$this->success ( '删除成功', Cookie ( '__forward__' ) );
			} else {
				$this->error ( '删除失败', Cookie ( '__forward__' ) );
			}
		} else {
			$this->error ( '非法操作', Cookie ( '__forward__' ) );
		}
	}
	
	/**
	 * 修改密码
	 */
	public function changepassword($id = '') {
		if (IS_POST) {
			$data = I ( 'post.' );
			if ($data ['password'] && $data ['confirmpassword']) {
				$model ['uid'] = $data ['uid'];
				$password = get_password ( $data ['password'] );
				$model ['password'] = $password ['password'];
				$model ['encrypt'] = $password ['encrypt'];
				if (D ( 'Member' )->save ( $model )) {
					// 记录行为
					action_log ( 'update_member', 'Member', $model ['uid'], UID );
					$this->success ( '修改成功！', Cookie ( '__forward__' ) );
				} else {
					$this->error ( '修改失败' );
				}
			} else {
				$this->error ( '新密码和确认密码不能为空' );
			}
		} else {
			$this->assign ( 'uid', $id );
			$this->assign ( 'meta_title', '修改密码' );
			$this->display ();
		}
	}
}