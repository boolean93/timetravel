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

class ImageController extends AdminController {
	/**
	 * 内容列表
	 */
	public function index() {
		// 生成查询条件
		if (I ( 'cid' )) {
			$map ['cid'] = I ( 'cid' );
		}
		if (I ( 'title' )) {
			$map ['title'] = array (
					'like',
					'%' . I ( 'title' ) . '%' 
			);
		}
		// 获取列表
		$list = $this->lists ( 'Image', $map, 'id' );
		$this->assign ( 'list', $list );
		$this->assign ( 'map', $map );
		$this->assign ( 'meta_title', '内容列表' );
		// 记录当前列表页的cookie
		Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] );
		$this->display ();
	}
	/**
	 * 添加内容
	 */
	public function add() {
		$this->meta_title = '新增内容';
		$this->assign ( 'info', null );
		$this->display ();
	}

	/**
	 * 删除内容
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
		if (M ( 'Image' )->where ( $map )->delete ()) {
			// 记录行为
			action_log ( 'delete_image', 'Image', $id, UID );
			$this->success ( '删除成功' );
		} else {
			$this->error ( '删除失败！' );
		}
	}

    /**
     * ueditor驱动
     */
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }

    /**
     * 图片上传
     */
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $url = __ROOT__.'/Uploads/'.$info['photo']['savepath'].$info['photo']['savename'];
            $data = array(
                "url"   =>  $url,
            );
            if ($id = D("Image")->data($data)->add()){
                // 记录行为
                action_log ( 'add_image', 'Image', $id, UID );
                $this->success('上传成功！');
            }else{
                $this->error("上传失败!");
            }
        }
    }
}