<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/2
 * Time: 上午12:19
 */

namespace app\index\behaviors\wechat;


use app\common\enum\QrKeyEnum;
use app\index\controller\Weixin;
use think\Cache;
use wechat\Tpwechat;

class Scan extends Base
{
    protected $openid;
    /**
     * @var Tpwechat
     */
    protected $api;
    /**
     * @param Weixin $params
     * @return mixed
     */
    function run(&$params)
    {
        $rev = $params->api->getRev();
        $event = $rev->getRevEvent();
        $this->openid = $rev->getRevFrom();
        $scene = $rev->getRevSceneId();
        $this->api = $params->api;
        if (!empty($scene) && ($event['event'] == 'SCAN')) {
            $this->api->text('扫码成功')->reply();
            exit;
        }
    }
}