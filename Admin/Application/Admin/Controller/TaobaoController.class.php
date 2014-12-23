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

/**
 * Class TaobaoController
 */
class TaobaoController extends AdminController {
	/**
	 * 编辑内容
	 */
	public function index() {
		if (IS_POST) {
			$Taobao = D ( 'Taobao' );
			$data = $Taobao->create();
			$Taobao->id = 1;
			if ($data) {
				if ($Taobao->save ()) {
					// 记录行为
					action_log ( 'edit_Taobao', 'Taobao', $data ['id'], UID );
					$this->success ( '更新成功' );
				} else {
					$this->error ( '更新失败' );
				}
			} else {
				$this->error ( $Taobao->getError () );
			}
		} else {
			$info = array ();
			/* 获取数据 */
			$info = M ( 'Taobao' )->field ( true )->find ();

			if (false === $info) {
				$this->error ( '获取配置信息错误' );
			}

			$this->assign ( 'info', $info );
			$this->meta_title = '绑定';
			$this->display ();
		}
	}
}