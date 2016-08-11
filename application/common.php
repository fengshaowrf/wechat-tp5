<?php

// 应用公共文件
use app\common\model\Config;
use think\Log;
use wechat\WechatBuilder;

/**
 * 获取微信api操作对象
 * @return \wechat\Tpwechat
 */
function getWechatApi()
{
    $options = getWechatOptions();
    $wechat = WechatBuilder::getInstance($options);
    return $wechat;
}

/**
 * 获取微信配置
 */
function getWechatOptions()
{
    $config = Config::getConfig();
    $appid = $config['app_id'];
    $appsecret = $config['app_secret'];
    $options = array(
        'token' => $config['token'],
        'appid' => $appid,
        'appsecret' => $appsecret
    );
    return $options;
}

/**
 * thinkphp5.0不支持redirect
 * 重写了一个
 * @param $url
 * @param int $time
 * @param string $msg
 */
function redirect($url, $time = 0, $msg = '')
{
    //多行URL地址支持
    $url = str_replace(array("\n", "\r"), '', $url);
    if (empty($msg))
        $msg = "系统将在{$time}秒之后自动跳转到{$url}！";
    if (!headers_sent()) {
        // redirect
        if (0 === $time) {
            header('Location: ' . $url);
        } else {
            header("refresh:{$time};url={$url}");
            echo($msg);
        }
        exit();
    } else {
        $str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if ($time != 0)
            $str .= $msg;
        exit($str);
    }
}

/**
 * 手动alert详细log
 * @param $title
 * @param $input_data
 * @param $direct
 * @return mixed
 */
function print_log($title, $input_data, $direct)
{
    $log['title'] = $title;
    $log['data'] = $input_data;
    $log['type'] = $direct;
    return Log::alert($log);
}

/**
 * 无权限
 */
function no_permission()
{
    http_response_code(403);
    exit;
}

/**
 * 未登录
 */
function no_login()
{
    http_response_code(401);
    exit;
}
