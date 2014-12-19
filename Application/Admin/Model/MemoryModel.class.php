<?php
namespace Home\Model;
use Think\Model\RelationModel;
Class MemoryModel extends RelationModel{

    protected $_validate = array(
        array("title", "require", "请输入标题"),
        array("content", "require", "请输入内容"),
        array("user_id", "require", "参数错误"),
    );

    protected $_auto = array(
        array('status','0'),
    );

    /**
     * @description 新增文章
     * @param $data
     */
    public function addMemory($data)
    {
        if($this->create($data)){
            $this->add();
        }else{
            $this->error($this->getError());
        }
    }

    /**
     * @description 删除文章
     * @param $condition
     */
    public function deleteMemory($condition)
    {
        $this->where($condition)->delete();
    }

    /**
     * @description 获取文章列表
     * @param $pageId 页码
     * @return array 结果集
     */
    public function getList($pageId)
    {
        $sumPerPage = C("ARTICLE_PER_PAGE");
        $limit = $sumPerPage * ($pageId - 1).",".$sumPerPage;

        $result = $this->where("status = 0")->limit($limit)->select();

        return $result;
    }

    /**
     * @description 更新文章
     * @param $id
     * @param $data
     * @return bool|string
     */
    public function updateMemory($id, $data)
    {
        if($this->create($data)){
            if($this->where(array("id" => $id))->save()){
                return true;
            }else{
                return $this->getError();
            }
        }else{
            return $this->getError();
        }
    }

    /**
     * @description 冻结文章
     * @param $id
     * @return bool|string
     */
    public function frozenMemory($id)
    {
        $data = array();
        $data['status'] = '1';
        if($this->where(array("id" => $id) )->save($data)){
            return true;
        }else{
            return $this->getError();
        }
    }

    /**
     * @description 解冻文章
     * @param $id
     * @return bool|string
     */
    public function unfrozenMemory($id)
    {
        $data = array();
        $data['status'] = '0';
        if($this->where(array("id" => $id) )->save($data)){
            return true;
        }else{
            return $this->getError();
        }
    }
}