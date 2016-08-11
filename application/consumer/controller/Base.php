<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/7/27
 * Time: 下午4:58
 */

namespace app\consumer\controller;


use think\Controller;


class Base extends Controller
{
    protected $uid;
    protected static $NO_ACCESS = array('errcode' => -1, 'errmsg' => '没有权限');

    public function _initialize()
    {
        ignore_user_abort(true);
        set_time_limit(0);
        if (!config('app_debug') && input('param.auth') != MQ_AUTH) {
            exit(json_encode(self::$NO_ACCESS));
        }
        $this->uid = input('param.uid');
    }
}