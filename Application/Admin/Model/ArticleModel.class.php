<?php
namespace Home\Model;
use Think\Model\RelationModel;
Class ArticleModel extends RelationModel{

    protected $_link = array(
        'Route'=>array(
            'mapping_type'  =>  self::MANY_TO_MANY,
            'class_name'    =>  "Route",
            "mapping_name"  =>  "route",
            "foreign_key"   =>  "article_id",
            "relation_foreign_key"  =>  "route_id",
            "relation_table"    =>  "relation_article_route",
        ),
    );

    protected $_validate = array(
        array("title", "require", "请输入标题"),
        array("content", "require", "请输入内容"),
    );

    protected $_auto = array(
        array('status','0'),
        array('good', '0', 1),
        array('click', '0', 1),
        array("create_time", "time", 1, "function"),
    );

    /**
     * @description 新增文章
     * @param $data
     */
    public function addArticle($data)
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
    public function deleteArticle($condition)
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
    public function updateArticle($id, $data)
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
    public function frozenArticle($id)
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
    public function unfrozenArticle($id)
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