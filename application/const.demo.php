<?php

//Redis 配置
define('REDIS_HOST', '127.0.0.1');
define('REDIS_PWD', 'password');

//数据库配置
define('DB_HOST', '127.0.0.1');
define('DB_PREFIX', 'tp_');
define('DB_DATABASE', 'test');
define('DB_PWD', 'password');
define('DB_USER', 'root');

//debug配置
define('APP_DEBUG', true);
define('SHOW_ERROR_MSG', true);

//定义应用域名,可以多号同时使用
define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('APP_PREFIX', 'project');
$app = explode('.', $_SERVER['HTTP_HOST'])[0];//取3级域名区分应用
$apps = ['test','www','local'];//定义应用
if (!in_array($app, $apps)) {
    exit('应用配置异常');
}
define('APP', $app);

//阿里云KEY
define('ONS_SK', 'ONS_SK_STRING');
define('ONS_AK', 'ONS_AK_STRING');

//阿里云MQ消息队列身份验证参数
define('MQ_AUTH', 'AUTHCODE');

//LOG路径
define('PRO_LOG_PATH', '/nfs/logs/panda/');