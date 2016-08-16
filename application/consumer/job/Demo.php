<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/15
 * Time: 上午11:47
 */

namespace app\consumer\job;


use think\queue\Job;

class Demo
{
    public function fire(Job $job, $data)
    {
        //发送模板消息
        $api = getWechatApi();
        $rs = $api->sendTemplateMessage($data);
        if (!$rs) {
            echo $api->errMsg;
            $job->release();
        }
        $job->delete();
    }

    public function failed(Job $job, $data)
    {
        dump($data);
        $job->delete();
    }
}