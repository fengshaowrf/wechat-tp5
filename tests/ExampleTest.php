<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
namespace tests;

class ExampleTest extends TestCase
{

    public function testBasicExample()
    {
        $this->visit('/')->see('ThinkPHP');
    }

    public function testDemo()
    {
        $this->visit('/index/demo/wechatapi');
    }

    public function testAuth()
    {
        $this->visit('/index/auth/wechat');
    }

    public function testDemoIndex()
    {
        $this->visit('/index/demo/index');
    }
}