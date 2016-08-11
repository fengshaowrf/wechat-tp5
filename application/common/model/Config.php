<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace app\common\model;

use think\Model;

class Config extends Model
{
    protected $table = 'tp_config';

    public static function getConfig()
    {
        $where['host'] = array('LIKE', '%' . APP . '%');
        if ($data = cache('config_' . APP)) return $data;
        $data = self::where($where)->find();
        $data = $data->toArray();
        cache('config_' . APP, $data, 3600);
        return $data;
    }
}