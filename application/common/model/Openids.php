<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/8/12
 * Time: 下午4:38
 */

namespace app\common\model;


use think\Model;

class Openids extends Model
{
    public function student()
    {
        $this->belongsTo('student');
    }
}