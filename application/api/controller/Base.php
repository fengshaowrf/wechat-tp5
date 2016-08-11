<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/9
 * Time: 下午5:54
 */

namespace app\api\controller;


use think\Cache;
use think\Controller;
use think\Request;

class Base extends Controller
{
    static $RESP_OK = array('errcode' => 0, 'errmsg' => 'ok');
    static $SYSTEM_ERR = array('errcode' => -1, 'errmsg' => '系统异常');

    protected function stuAuth()
    {
        $stu = $this->tokenUser();
        if (!$stu) no_login();
        if (!isset($stu['status']) || $stu['status'] != 3) no_permission();
        return $stu;
    }

    protected function wxAuth()
    {
        $user = $this->tokenUser();
        if (!$user || !isset($user['openid'])) no_login();
        return $user;
    }

    private function tokenUser()
    {
        $req = Request::instance();
        $token = $req->header('token');
        return Cache::get($token);
    }
}