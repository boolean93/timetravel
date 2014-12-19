<?php
return array(
	//设置访问列表
	'MODULE_ALLOW_LIST' => array('Home','Admin'),
	//'DEFAULT_MODULE' => 'Admin',

    'SHOW_PAGE_TRACE'=>true,
    'URL_MODEL'             =>  "0",
    'URL_CASE_INSENSITIVE'  =>  true,

    //数据库配置
	'DB_TYPE'               =>  'pdo',     		// 数据库类型
    'DB_HOST'               =>  'localhost', 		// 服务器地址
    'DB_NAME'               =>  'timetravel',       // 数据库名
    'DB_USER'               =>  'root',      		// 用户名
    'DB_PWD'                =>  '',    	    	    // 密码
    'DB_PREFIX'   			=>	'',					//表前缀
    'DB_DSN'    => 'mysql:host=localhost;dbname=timetravel;charset=utf8',

    'PASSWORD_SALT'         =>  "Hey,TimeTravel",

    "ARTICLE_PER_PAGE"      =>  "6",                //单页显示文章数

    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),
);





