<?php
// +----------------------------------------------------------------------
// | OneDream 前台主页控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.coolhots.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-5
// +----------------------------------------------------------------------
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index() {
		/**
		 * 后台开发期间，默认跳转页面到后台主页
		 */
		$this->redirect ( 'admin/index/index' );
	}
}