<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/1
 * Time: 下午11:20
 */

namespace app\index\behaviors\wechat;




use app\index\controller\Weixin;

abstract class Base
{
    /**
     * @param Weixin $params
     * @return mixed
     */
    abstract function run(&$params);
}