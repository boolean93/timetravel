<?php
// +----------------------------------------------------------------------
// | OneDream 后台主页控制器
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
use Think\Model;

class ErcodeController extends AdminController {
	public function index($id = 1)
	{
		$info = array ();
		/* 获取数据 */
		$info = M ( 'Ercode' )->field ( true )->find ( $id );
		if (false === $info) {
			$this->error ( '获取配置信息错误' );
		}

		$this->assign ( 'info', $info );
		$this->meta_title = '编辑二维码';
		$this->display ();
	}

	public function edit($id = 1)
	{
		if (IS_POST) {
			$Stuff = D ( 'Ercode' );
			$data = $Stuff->create ();
			if ($data) {
				if ($Stuff->save ()) {
					// 记录行为
					action_log ( 'edit_ercode', 'Ercode', $data ['id'], UID );
					$this->success ( '更新成功' );
				} else {
					$this->error ( '更新失败' );
				}
			} else {
				$this->error ( $Stuff->getError () );
			}
		}
	}
}