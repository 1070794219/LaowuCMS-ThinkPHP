<?php
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST' => array('Home','Admin'),
	'DEFAULT_MODULE' => 'Home',
	
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__ . '/Public',
    	'__CSS__' => __ROOT__ . '/Public/css',
    	'__JS__' => __ROOT__ . '/Public/js',
    	'__IMG__' => __ROOT__ . '/Public/images',
    	'__LAY__' => __ROOT__ . '/Public/layui',
	),

	//连接数据库
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'laowu',
	'DB_USER' => 'root',
	'DB_PWD' => '123456',
	'DB_PORT' => '3306',
	'DB_PREFIX' => '',

	//系统配置
	'LOAD_EXT_CONFIG' => 'settings'
);