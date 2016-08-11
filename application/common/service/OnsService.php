<?php
/**
 * Created by PhpStorm.
 * User: bling
 * Date: 16/7/27
 * Time: 下午5:45
 */

namespace app\common\service;


use Curl\Curl;

define('ONS_URL', "http://beijing-rest-internet.ons.aliyun.com/");

/**
 * 发送队列消息到阿里云的MQ服务
 * 需要填写的是$key(消息key)和$msg (消息内容,内容详情见buildMsg()方法)
 * Class OnsService
 * @package app\common\service
 */
class OnsService
{
    /**
     * 生产消息事件
     * @param $key
     * @param $msg
     * @return string
     */
    public static function produce($key, $msg)
    {
        $ons = new Ons($key, $msg, Ons::TYPE_EVENT);
        return $ons->post();
    }

    /**
     * 模板消息
     * @param string $key
     * @param string $msg 模板消息json数据
     * @return string
     */
    public static function template($key, $msg)
    {
        $ons = new Ons($key, $msg, Ons::TYPE_TEMPLATE);
        return $ons->post();
    }

    /**
     * 构建消息
     * @param string $url 消费业务地址
     * @param array $data 消费业务需要通过POST传递的数据(raw data)
     * @param int $delay 延时消费的时间戳
     * @param string $method 请求方式
     * @return array
     */
    public static function buildEventMsg($url, $data = [], $delay = 0, $method = 'GET')
    {
        if (is_array($data)) $data = json_encode($data);
        if (stripos($url, 'auth') === false) {
            $append = (stripos($url, '?') === false ? '?' : '&') . 'auth=' . MQ_AUTH;
            $url .= $append;
        }
        $msg = [
            'url' => $url,
            'data' => $data,
            'type' => $method
        ];
        if ($delay != 0) $msg['delay'] = $delay;
        return json_encode($msg);
    }
}

class Ons
{
    protected $url;
    protected $param;
    protected $head;

    //TODO 这里是hard code 应写在配置文件里面
    public static $TOPICS = [0 => ['PANDA_EVENT_PRO', 'PANDA_TMP_MSG_PRO'], 1 => ['PANDA_EVENT_DEV', 'PANDA_TMP_MSG']]; // 0 生产 1 测试
    public static $PID = [0 => ['PID_EVENT_PRO', 'PID_SEND_TMP_PRO'], 1 => ['PID_EVENT_DEV', 'PID_SEND_TMP']]; // 0 生产 1 测试
    protected $app_debug = 0;
    /**
     *  生产消费事件
     */
    const TYPE_EVENT = 0;

    /**
     *  模板消息事件
     */
    const TYPE_TEMPLATE = 1;

    /**
     * Ons constructor.
     * @param $key
     * @param $msg
     * @param $type 0 生产消费事件  1 发送模板消息
     */
    public function __construct($key, $msg, $type)
    {
        $time = time() * 1000;
        $this->app_debug = (int)config('app_debug');
        $topic = self::$TOPICS[$this->app_debug][$type];
        $pid = self::$PID[$this->app_debug][$type];
        $this->url = ONS_URL . "message/?topic={$topic}&time={$time}&tag={$key}&key={$key}";
        $body_md5 = md5($msg);
        $signString = "$topic\n$pid\n$body_md5\n$time";
        $sign = self::getSignature($signString, config('ons_sk'));
        $head['Signature'] = $sign;
        $head['AccessKey'] = config('ons_ak');
        $head['ProducerId'] = $pid;
        $head['cache-control'] = "no-cache";
        $head['Content-Type'] = 'text/plain;charset=UTF-8';
        $this->param = $msg;
        $this->head = $head;
    }

    private function getSignature($str, $key)
    {
        if (function_exists('hash_hmac')) {
            $signature = base64_encode(hash_hmac("sha1", $str, $key, true));
        } else {
            $blocksize = 64;
            $hashfunc = 'sha1';
            if (strlen($key) > $blocksize) {
                $key = pack('H*', $hashfunc($key));
            }
            $key = str_pad($key, $blocksize, chr(0x00));
            $ipad = str_repeat(chr(0x36), $blocksize);
            $opad = str_repeat(chr(0x5c), $blocksize);
            $hmac = pack(
                'H*', $hashfunc(
                    ($key ^ $opad) . pack(
                        'H*', $hashfunc(
                            ($key ^ $ipad) . $str
                        )
                    )
                )
            );
            $signature = base64_encode($hmac);
        }
        return $signature;
    }


    /**
     * POST 请求
     * @return string content
     */
    public function post()
    {
        $start = time();
        $curl = new Curl();
        foreach ($this->head as $key => $val) {
            $curl->setHeader($key, $val);
        }
        $curl->post($this->url, $this->param);
        $rs = $curl->response;
        $curl->close();
        $end = time();
        $d = $end - $start;
        if ($curl->httpStatusCode != 201 || $d > 2 || $this->app_debug) {
            print_log('MQ消息日志(debug)', $rs . 'time:' . $d . ' http_status:' . $curl->httpStatusCode, 'mq_http_post.log');
            return json_decode($rs, true);
        }
        return json_decode($rs, true);
    }

}