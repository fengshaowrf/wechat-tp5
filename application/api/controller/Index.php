<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/12
 * Time: 上午12:42
 */

namespace app\api\controller;


class Index extends Base
{
    public function index()
    {
        return json(self::$RESP_OK);
    }
}