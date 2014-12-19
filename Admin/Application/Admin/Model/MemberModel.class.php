<?php
// +----------------------------------------------------------------------
// | OneDream 用户模型
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.coolhots.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-6
// +----------------------------------------------------------------------
namespace Admin\Model;

use Think\Model;

class MemberModel extends Model {
	protected $_validate = array (
			array (
					'username',
					'1,30',
					- 1,
					self::EXISTS_VALIDATE,
					'length' 
			), // 用户名长度不合法
			array (
					'username',
					'',
					- 3,
					self::EXISTS_VALIDATE,
					'unique' 
			), // 用户名被占用
			array (
					'nickname',
					'1,16',
					'昵称长度为1-16个字符',
					self::EXISTS_VALIDATE,
					'length' 
			),
			array (
					'nickname',
					'',
					'昵称被占用',
					self::EXISTS_VALIDATE,
					'unique' 
			)  // 用户名被占用
);

	



function lists($status = 1, $order = 'uid DESC', $field = true) {
	$map = array (
			'status' => $status 
	);
	return $this->field ( $field )->where ( $map )->order ( $order )->select ();
}
	
	/**
	 * 根据用户编号获取用户所属的角色
	 */
	public function getUserRoles($uid) {
		$map ['uid'] = $uid;
		$role = $this->where ( $map )->find ();
		if ($role) {
		} else {
			return null;
		}
	}
	/**
	 * 用户登录
	 * 用户名
	 * 密码
	 */
	public function login($username, $password) {
		$map ['username'] = $username;
		$user = $this->where ( $map )->find ();
		if (! $user || 1 != $user ['status']) {
			$this->error = '用户不存在或已被禁用！'; // 应用级别禁用
		} else {
			$checkpassword = get_password ( $password, $user ['encrypt'] );
			if ($checkpassword == $user ['password']) {
				$data ['uid'] = $user ['uid'];
				$data ['login'] = $user ['login'] + 1;
				$data ['last_login_ip'] = get_client_ip ();
				$data ['last_login_time'] = NOW_TIME;
				$this->save ( $data );
				/* 记录登录SESSION和COOKIES */
				$auth = array (
						'uid' => $user ['uid'],
						'nickname' => $user ['nickname'],
						'username' => $user ['nickname'],
						'last_login_time' => $user ['last_login_time'],
						'roleid' => $user ['roleid'],
						'auth' => $user ['auth'] 
				);
				
				session ( 'user_auth', $auth );
				session ( 'user_auth_sign', data_auth_sign ( $auth ) );
				$this->loadAuth($user ['roleid'],$user ['auth']);
				return $user ['uid'];
			} else {
				$this->error = '密码错误！';
			}
		}
	}
	
	/**
     * 根据用户的角色编号和用户单独分配的权限来读取规则菜单
	 */
	public function loadAuth($roleid,$userauth){
		//获取角色信息
		$role_info=D('Role')->field('auth,status')->where('id='.$roleid)->find();
		if($role_info['auth'] && $userauth){ //合并用户组权限和用户单独权限
			$auth = $role_info['auth'].','.$userauth;
		}else{
			$auth = $userauth?$userauth:$role_info['auth'];
		}
		$auth_array=explode(',',$auth);
		$auth_array=array_unique($auth_array);//去重复
		session ( 'roleauth', $auth_array );
		
	}
	
	/**
	 * 注销当前用户
	 *
	 * @return void
	 */
	public function logout() {
		session ( 'user_auth', null );
		session ( 'user_auth_sign', null );
		session('roleauth',null);
	}
	public function getNickName($uid) {
		return $this->where ( array (
				'uid' => ( int ) $uid 
		) )->getField ( 'nickname' );
	}
}