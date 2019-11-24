<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait LastActivedAtHelper
{

    // 缓存相关
    protected $hash_prefix = 'larabbs_last_active_at';
    protected $field_prefix = 'user_';

    public function getLastActiveAtAttribute($value)
    {
        // redis hash 表的命名
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());;

        // 字段名称
        $field = $this->getHashField();

        // 优先使用 Redis 的数据否则就是数据库中的数据
        $dateTime = \Redis::hGet($hash,$field) ? : $value;

        if ($dateTime){
            return new Carbon($dateTime);
        }else{
            return $this->created_at;
        }
    }
    public function recordLastActiveAt()
    {
        // 获取今天的日期
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());;

        // 字段名称
        $field = $this->getHashField();

        // 当前时间
        $now = Carbon::now()->toDateTimeString();

        // 数据写入redis,字段保存被更新
        \Redis::hSet($hash, $field, $now);
    }

    public function syncUserActivedAt()
    {
        // 获取昨日的日期
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());;

        // 从 Redis 中获取 hash 表里的所有数据
        $dates = \Redis::hGetAll($hash);

        // 遍历,并同步到数据库
        foreach ($dates as $user_id => $active_at) {
            $user_id = str_replace($this->field_prefix, '', $user_id);

            if ($user = $this->find($user_id)){
                $user->last_active_at = $active_at;
                $user->save();
            }
        }

        \Redis::del($hash);
    }

    public function getHashFromDateString($date)
    {
        // Redis 哈希表的命名，如：larabbs_last_actived_at_2017-10-21
        return $this->hash_prefix . $date;
    }
    public function getHashField()
    {
        // 字段名称，如：user_1
        return $this->field_prefix . $this->id;
    }

}
