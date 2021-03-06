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
        array("password", "myMd5", 1, 'function'),
        array("status", "1"),
        array("register_time", "time", 1, 'function'),
        array("last_login_time", "time", 2, 'function'),
    );
}