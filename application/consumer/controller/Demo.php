<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/11
 * Time: 下午12:00
 */

namespace app\consumer\controller;


use think\Log;

class Demo extends Base
{
    public function test()
    {
        $param = input('param.id');
        echo $param;
        echo "do something";
        echo "finish";
        Log::alert('consumer test finish');
    }
}