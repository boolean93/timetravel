<?php
// +----------------------------------------------------------------------
// | OneDream  行为模型
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.coolhots.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolHots <coolhots@outlook.com>
// +----------------------------------------------------------------------
// | Date: 2014-4-21
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;


class ActionModel extends Model {

    /* 自动验证规则 */
    protected $_validate = array(
        array('name', 'require', '行为标识必须', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '/^[a-zA-Z]\w{0,39}$/', '标识不合法', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '', '标识已经存在', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH),
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,80', '标题长度不能超过80个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
        array('remark', 'require', '行为描述不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('remark', '1,140', '行为描述不能超过140个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
    );

    /* 自动完成规则 */
    protected $_auto = array(
        array('status', 1, self::MODEL_INSERT, 'string'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
    );

    /**
     * 根据行为标识获取行为编号
     */
    public function getByName($action){
    	$map['name']=$action;
    	$data=$this->where($map)->find();
    	return $data;
    }

}
