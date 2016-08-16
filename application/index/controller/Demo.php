<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/11
 * Time: 下午11:42
 */

namespace app\index\controller;


use app\common\service\OnsService;
use think\queue\Queue;

class Demo extends Base
{

    public function info()
    {
        phpinfo();
    }

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

    public function job()
    {
        $data = '{
           "touser":"oYZEQv5A-zn6o6y375dRVgjFFlrE",
           "template_id":"IveEY7MF5Xqje3WFdwZYb3kHrffozEEYljEBfWjADf8",
           "url":"http://weixin.qq.com/download",            
           "data":{
                   "first": {
                       "value":"恭喜你购买成功！",
                       "color":"#173177"
                   },
                   "keynote1":{
                       "value":"巧克力",
                       "color":"#173177"
                   },
                   "keynote2": {
                       "value":"39.8元",
                       "color":"#173177"
                   },
                   "remark":{
                       "value":"欢迎再次购买！",
                       "color":"#173177"
                   }
           }
       }';
        $data = json_decode($data, true);
        for ($i = 0; $i < 100; $i++) {
            $data['data']['first']['value'] = $i . '购买成功';
            Queue::push('app\\consumer\\job\\Demo', $data);
        }
        $data['touser'] = 'dsfsdf';
        Queue::push('app\\consumer\\job\\Demo', $data);
    }
}