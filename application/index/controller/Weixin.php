<?php
/**
 * Created by PhpStorm.
 * User: Hsin
 * Date: 2016/4/4
 * Time: 9:47
 */

namespace app\index\controller;


use app\common\model\Config;
use think\Controller;
use Think\Hook;
use wechat\Tpwechat;
use wechat\WechatUtil;


class Weixin extends Controller
{
    /**
     * @var Tpwechat
     */
    public $api;

    public function _initialize()
    {
        $this->api = getWechatApi();
    }

    public function index()
    {
        if (!empty($_GET['echostr'])) {
            $this->api->valid();
        }
        $rev = $this->api->getRev();
        $toUserName = $rev->getRevTo();
        Hook::add('SCAN', 'app\\index\\behaviors\\wechat\\Scan');
        Hook::add('HOME', 'app\\index\\behaviors\\wechat\\Home');
        Hook::listen('SCAN', $this);
        Hook::listen('HOME', $this);
        $config = Config::getConfig();
        WechatUtil::forward($config['forward_url'], $config['forward_token'], $toUserName);
        exit;
    }
}