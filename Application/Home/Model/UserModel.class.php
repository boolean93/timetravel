<?php
namespace Home\Model;
use Think\Model\RelationModel;
Class UserModel extends RelationModel{
    protected $_validate = array(
        array("verify", "require", "请输入验证码"),
        array("username", '', "账号已经存在", 0, 'unique', 1),
        array("username", "checkUserName", "邮箱验证失败", 0, 'function'),
        array('repassword', 'password', '确认密码与密码不一致', 0, 'confirm'),
        array("password", 'checkPwd', '密码格式错误(6-15位)', 0, 'function'),
    );

    protected $_auto = array(
        array("password", "md5", 3, 'function'),
        array("status", "1"),
        array("register_time", "time", MODEL_INSERT, 'function'),
        array("login_time", "time", MODEL_BOTH, 'function'),
    );
}