<?php
namespace Home\Model;
use Think\Model\RelationModel;
Class UserModel extends RelationModel{
    protected $_validate = array(
        array("verify", "require", "请输入验证码"),
        array("username", '', "账号已经存在", 0, 'unique', 1),

    );
}