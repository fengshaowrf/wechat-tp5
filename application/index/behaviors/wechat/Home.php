<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/1
 * Time: 下午11:24
 */

namespace app\index\behaviors\wechat;


use app\index\controller\Weixin;
use wechat\Wechat;

class Home extends Base
{

    /**
     * @param Weixin $params
     * @return mixed
     */
    function run(&$params)
    {
        $rev = $params->api->getRev();
        $msgtype = $rev->getRevType();
        $openid = $rev->getRevFrom();
        $content = $params->api->getRevContent();
        if(Wechat::MSGTYPE_TEXT ==  $msgtype && stripos($content,'首页') !== false){
            $params->api->text('hello home.'.$openid)->reply();
            exit;
        }
    }
}