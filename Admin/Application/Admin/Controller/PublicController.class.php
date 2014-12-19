<?php
// +----------------------------------------------------------------------
// | OneDream 后台公开控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.coolhots.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-5
// +----------------------------------------------------------------------
namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller {
	/**
	 * 登录
	 */
	public function login($username = '', $password = '') {
		if (IS_POST) {
			if (empty ( $username )) {
				$this->error ( '用户名不能为空！' );
			}
			if (empty ( $password )) {
				$this->error ( '密码不能为空！' );
			}
			$model = D ( 'Member' );
			$uid=$model->login ( $username, $password );
			if ($uid) {
				//记录行为
				action_log('user_login','Member',$uid,$uid);
				$this->success ( '登录成功！', U ( 'Index/index' ) );
			} else {
				$this->error ( $model->geterror () );
			}
		} else {
			$this->display ();
		}
	}
	public function ieupdate() {
		$this->display ();
	}
	
	/* 退出登录 */
	public function logout(){
		if(is_login()){
			D('Member')->logout();
			session('[destroy]');
			$this->success('退出成功！', U('login'));
		} else {
			$this->redirect('login');
		}
	}
}


