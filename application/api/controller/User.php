<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/12
 * Time: 上午12:48
 */

namespace app\api\controller;


class User extends Base
{
    public function index()
    {
        return json($this->wxAuth());
    }
}