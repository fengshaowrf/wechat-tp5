<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/11
 * Time: 下午4:37
 */

namespace app\index\controller;


use think\Controller;

class Auth extends Controller
{
    public function wechat($loading = 0, $type = 'snsapi_base')
    {
        $refer = input('param.refer');
        $api = getWechatApi();
        //从Http head中加载refer
        if (!$refer) $refer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';
        if (!$refer) $refer = HOST . APP_PREFIX; //还不存在就跳转到首页
        $redirect = $api->getOauthRedirect($refer, $type, $type);
        if (!$loading) {
            redirect($redirect);
            exit;
        }
        $this->assign('url', $redirect);
        return $this->fetch('loading');
    }
}