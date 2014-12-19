<?php
// +----------------------------------------------------------------------
// | OneDream 栏目管理控制器
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

class CategoryController extends AdminController {
	/**
	 * 栏目列表
	 */
	public function index() {
		$list = D ( 'Category' )->select ();
		$list = D ( 'Common/Tree' )->toFormatTree ( $list, $title = 'title', $pk = 'cid', $pid = 'pid', $root = 0 );
		$this->assign ( 'list', $list );
		$this->assign ( 'meta_title', '栏目列表' );
		// 记录当前列表页的cookie
		Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] );
		$this->display ();
	}
	/**
	 * 添加栏目
	 */
	public function add() {
		if (IS_POST) {
			$Category = D ( 'Category' );
			$data = $Category->create ();
			if ($data) {
				$id = $Category->add ();
				if ($id) {
					// 记录行为
					action_log ( 'add_category', 'Category', $id, UID );
					$this->success ( '新增成功', U ( 'index' ) );
				} else {
					$this->error ( '新增失败' );
				}
			} else {
				$this->error ( $Category->getError () );
			}
		} else {
			$category = M ( 'Category' )->field ( true )->select ();
			$category = D ( 'Common/Tree' )->toFormatTree ( $category, $title = 'title', $pk = 'cid', $pid = 'pid', $root = 0 );
			$this->assign ( 'category', $category );
			$this->meta_title = '新增栏目';
			$this->assign ( 'info', null );
			$this->display ();
		}
	}
	/**
	 * 编辑栏目
	 */
	public function edit($id = 0) {
		if (IS_POST) {
			$Category = D ( 'Category' );
			$data = $Category->create ();
			if ($data) {
				if ($Category->save ()) {
					// 记录行为
					action_log ( 'edit_category', 'Category', $data ['id'], UID );
					$this->success ( '更新成功', Cookie ( '__forward__' ) );
				} else {
					//$this->error ( '更新失败' );
					$this->error(json_encode($data));
				}
			} else {
				$this->error ( $Category->getError () );
			}
		} else {
			$info = array ();
			/* 获取数据 */
			$info = M ( 'Category' )->field ( true )->find ( $id );
			
			if (false === $info) {
				$this->error ( '获取栏目信息错误' );
			}
			$category = M ( 'Category' )->field ( true )->select ();
			$category = D ( 'Common/Tree' )->toFormatTree ( $category, $title = 'title', $pk = 'cid', $pid = 'pid', $root = 0 );
			$this->assign ( 'category', $category );
			$this->assign ( 'info', $info );
			$this->meta_title = '编辑栏目';
			$this->display ();
		}
	}
	
	/**
	 * 删除栏目
	 */
	public function delete() {
		$id = array_unique ( ( array ) I ( 'id', 0 ) );
		
		if (empty ( $id )) {
			$this->error ( '请选择要操作的数据!' );
		}
		
		$map = array (
				'cid' => array (
						'in',
						$id 
				) 
		);
		if (M ( 'Category' )->where ( $map )->delete ()) {
			// 记录行为
			action_log ( 'delete_category', 'Category', $id, UID );
			$this->success ( '删除成功' );
		} else {
			$this->error ( '删除失败！' );
		}
	}
}