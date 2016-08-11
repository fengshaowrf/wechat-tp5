<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/11
 * Time: 下午11:42
 */

namespace app\index\controller;


use app\common\service\OnsService;

class Demo extends Base
{
    public function index()
    {
        $user = $this->wxAuth();
        dump($user);
    }

    public function wechatapi()
    {
        $api = getWechatApi();
        $list = $api->getUserList();
        dump($list);
    }

    public function ons()
    {
        $url = HOST . "groups/consumer/demo/test?id=1000";
        $msg = OnsService::buildEventMsg($url);
        OnsService::produce('demo', $msg);
    }
}