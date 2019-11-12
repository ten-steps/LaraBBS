<?php


namespace App\Handlers;


use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;
class SlugTranslateHandler
{
    public function translate($text)
    {
        $http = new Client();

        //初始化配置
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('services.baidu_translate.appid');
        $key= config('services.baidu_translate.key');
        $salt = time();

        //如果没有执行百度翻译，则执行拼音
        if (empty($appid) || empty($key)) {
            return $this->pinyin($text);
        }

        //构建请求参数
        $sign = md5($appid. $text . $salt . $key);
        $query = http_build_query([
            "q" => $text,
            "from" => "zh",
            "to" => "en",
            "appid" => $appid,
            "salt" => $salt,
            "sign" => $sign,
        ]);

        //发送 HTTP GET请求
        $response = $http->get($api.$query);
        $result = json_decode($response->getBody(),true);
        //获取翻译结果
        if ($result['trans_result'][0]['dst']){
            return str_slug($result['trans_result'][0]['dst']);
        }else{
            return $this->pinyin($text);
        }
    }

    public function pinyin($text){
        return str_slug(app(Pinyin::class)->permalink($text));
    }
}
