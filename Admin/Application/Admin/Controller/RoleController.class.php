<?php
// +----------------------------------------------------------------------
// | OneDream 角色管理
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

class RoleController extends AdminController {
	/**
	 * 角色列表
	 */
	public function index() {
		$list = D ( 'Role' )->select ();
		$list = int_to_string ( $list, array (
				'status' => array (
						1 => '正常',
						0 => '禁用' 
				) 
		) );
		$this->assign ( 'list', $list );
		$this->assign ( 'map', $map );
		$this->assign ( 'meta_title', '角色列表' );
		// 记录当前列表页的cookie
		Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] );
		$this->display ();
	}
	/**
	 * 角色授权
	 */
	public function auth() {
		$id = I ( 'id' );
		if (IS_POST) {
			$authdata = I ( 'auth' );
			$Role = D ( "Role" ); // 实例化Role对象
			$data['id']=$id;
			$data ['auth'] = $authdata;
			// 根据条件更新记录
			if($Role->save ( $data )) 
			{
			$member = D ( 'Member' );
			$user = session ( 'user_auth' );
			$userauth = $user ['auth'];
			$member->loadAuth ( $id, $userauth );
			// 记录行为
			action_log ( 'role_auth', 'Role', $id, UID );
			$this->success ( '授权成功', U ( 'index' ) );
			}
			else {
				$this->error ( '授权失败！' );
			}
		} else {
			$info = D ( 'Role' )->find ( $id );
			$auth_data=explode(',',$info['auth']);
			$auth_list = D ( 'Auth' )->field ( 'id,title as name,pid as pId' )->select ();
			$auth = array ();
			$auth_array = session ( 'roleauth' );
			foreach ( $auth_list as $v => $k ) {
				if (! in_array ( $k ['id'],$auth_data  )) {
					$k ['checked'] = false;
				} else {
					$k ['checked'] = true;
				}
				$k ['open'] = true;
				$auth [] = $k;
			}
			
			if ($info) {
				$this->assign ( 'info', $info );
				$this->assign ( 'Auth', json_encode ( $auth ) );
				$this->assign ( 'meta_title', '角色授权' );
				$this->display ();
			} else {
				$this->error ( '获取角色信息失败！' );
			}
		}
	}
	
	/**
	 * 添加角色
	 */
	public function add() {
		if (IS_POST) {
			$Role = D ( 'Role' );
			$data = $Role->create ();
			if ($data) {
				$id = $Role->add ();
				if ($id) {
					// 记录行为
					action_log ( 'add_role', 'Role', $id, UID );
					$this->success ( '新增成功', U ( 'index' ) );
				} else {
					$this->error ( '新增失败' );
				}
			} else {
				$this->error ( $Role->getError () );
			}
		} else {
			$this->meta_title = '新增角色';
			$this->assign ( 'info', null );
			$this->display ();
		}
	}
	
	/**
	 * 编辑角色
	 */
	public function edit($id = 0) {
		if (IS_POST) {
			$Role = D ( 'Role' );
			$data = $Role->create ();
			if ($data) {
				if ($Role->save ()) {
					// 记录行为
					action_log ( 'edit_role', 'Role', $data ['id'], UID );
					$this->success ( '更新成功', Cookie ( '__forward__' ) );
				} else {
					$this->error ( '更新失败' );
				}
			} else {
				$this->error ( $Role->getError () );
			}
		} else {
			$info = array ();
			/* 获取数据 */
			$info = M ( 'Role' )->field ( true )->find ( $id );
			
			if (false === $info) {
				$this->error ( '获取角色信息错误' );
			}
			$this->assign ( 'info', $info );
			$this->meta_title = '编辑角色';
			$this->display ();
		}
	}
	
	/**
	 * 删除角色
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
		if (M ( 'Role' )->where ( $map )->delete ()) {
			// 记录行为
			action_log ( 'delete_role', 'Role', $id, UID );
			$this->success ( '删除成功' );
		} else {
			$this->error ( '删除失败！' );
		}
	}
}