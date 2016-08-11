<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/11
 * Time: 下午6:34
 */

namespace app\common\helper;


use wechat\UserHelper;

class PandaUserHelper extends UserHelper
{

    /**
     * 通过授权获取的openid到获取持久化的用户信息
     * @param $openid
     * @return
     */
    function get($openid)
    {
        //TODO 从数据库获取用户信息
        return false;
    }

    /**
     * debug用户
     */
    function debug()
    {
        // TODO: Implement debug() method.
    }

    /**
     * 获取会话中保存的用户信息
     */
    function getSession()
    {
        // TODO: Implement getSession() method.
        return session($this->session_key);
    }

    /**
     * 设置会话中的用户信息
     * @param $user
     * @return mixed
     */
    function setSession($user)
    {
        // TODO: Implement setSession() method.
        return session($this->session_key, $user);
    }

    /**
     * 设置会话中的HTTP_REFER
     * @param $refer
     * @return
     */
    function saveRefer($refer)
    {
        // TODO: Implement saveRefer() method.
    }
}