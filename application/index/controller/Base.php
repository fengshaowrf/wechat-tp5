<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/11
 * Time: 下午5:34
 */

namespace app\index\controller;


use app\common\helper\PandaUserHelper;
use think\Controller;
use wechat\WechatUtil;

/**
 * 多页前后端不完全分离架构
 * Class WxBase
 * @package app\index\controller
 */
class Base extends Controller
{
    protected function stuAuth()
    {
        $user = self::authUser();
        if (!$user) no_login();
        if (!isset($user['status']) || $user['status'] != 3) no_permission();
        return $user;
    }

    protected function wxAuth()
    {
        $user = self::authUser();
        if (!$user || !isset($user['openid'])) no_login();
        return $user;
    }

    private function authUser()
    {
        $helper = new PandaUserHelper('student');
        $options = getWechatOptions();
        $user = WechatUtil::userAuth($helper, $options, HOST);
        return $user;
    }
}