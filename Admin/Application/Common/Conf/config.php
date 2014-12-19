<?php
$db = require ('dbconfig.php');
$version = require ('version.php');
$config = array (
		/**
		 * 模块相关配置
		 */
		/**
		 * 扩展模块列表
		 */
		'AUTOLOAD_NAMESPACE' => array (
				'Addons' => ONEDREAM_ADDON_PATH 
		),
		'HOOKS_TYPE' => array (
				1 => '视图',
				2 => '控制器' 
		),
		/**
		 * 用户相关设置
		 */
		/**
		 * 最大缓存用户数
		 */
		'USER_MAX_CACHE' => 1000,
		/**
		 * 默认false 表示URL区分大小写 true则表示不区分大小写
		 */
		'URL_CASE_INSENSITIVE' => false,
		/**
		 * URL访问模式,可选参数0、1、2、3,代表以下四种模式：
		 * 0 (普通模式); 1 (PATHINFO 模式);
		 * 2 (REWRITE 模式); 3 (兼容模式)
		 * 默认为PATHINFO 模式
		 */
		'URL_MODEL' => 3,
		/**
		 * URL伪静态后缀设置
		 */
		'URL_HTML_SUFFIX' => 'html',
		/**
		 * URL禁止访问的后缀设置
		 */
		'URL_DENY_SUFFIX' => 'ico|png|gif|jpg',
		/**
		 * 默认模块
		 */
		'DEFAULT_MODULE' => 'Admin',
		/**
		 * 系统数据加密设置
		 * 默认数据加密KEY
		 */
		'DATA_AUTH_KEY' => 'A$@4SM/{3dq,tcoQ@y]|l2=DK-#gZD:M(;PY+~JG' ,


);
$newconfig = array_merge ( $db, $config );
return array_merge ( $newconfig, $version ); 