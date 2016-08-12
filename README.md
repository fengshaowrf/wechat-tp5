wechat-dev-tp5
===============


基于thinkphp5.0和微信公众平台项目的基础设施搭建,实现clone项目后即开始写业务代码

 + 集成微信api类库,可以直接调用
 + 微信授权
 + 基于阿里云mq消息队列实现生产消费实现
 + 支持多域名多号共享数据

> ThinkPHP5的运行环境要求PHP5.4以上。


## 使用 Composer 安装 ThinkPHP5
~~~
composer create-project topthink/think tp5 dev-master --prefer-dist
~~~
> 因为目前 ThinkPHP 5 正处于高速发展阶段，所以目前只能通过 dev-master 分支来初始化项目

## 目录结构

项目结构同thinkphp5.0官方结构,可以查看官方文档 [ThinkPHP5源码](https://github.com/top-think/think)

application详细介绍 

```
api //api接口模块
common //公共模块
    helper //助手类
        PandaUserHelper.php //熊猫书院用户助手example
    model  //模型
        Config.php  //项目配置表(公众号appid,sercret,支付配置,host)
    service  //服务
        OnsService // 生产消息到阿里云mq消息队列
consumer  //消费者模块
    controller //控制器(消费是通过编写对应的控制器作为入口,使用中间件去执行)
        Base.php //基类
index   //普通模块,配合模板使用                
    controller //控制器
    view  //页面模板
    behaviors //行为
       wechat  //微信消息对应的行为
          Base.php //基类
          Home.php  //首页关键字对应的行为
          Scan.php  //扫码行为
```

有混乱或有问题的地方欢迎反馈