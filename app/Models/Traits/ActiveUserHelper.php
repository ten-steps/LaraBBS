<?php

namespace App\Models\Traits;

use App\Models\Reply;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

trait ActiveUserHelper
{
    // 用于存放临时用户信息
    protected $users = [];

    // 配置信息
    protected $topic_weight = 4; // 话题权重
    protected $reply_weight = 1; // 回复权重
    protected $pass_day = 7; // 多少天内发表过内容
    protected $user_number = 6; // 取出来多少用户

    // 缓存相关配置

    protected $catch_key = 'larabbs_active_users';
    protected $catch_expire_in_minutes = 65;

    public function getActiveUsers()
    {
        return Cache::remember($this->catch_key,$this->catch_expire_in_minutes,function (){
            $this->calculateActiveUsers();
        });
    }

    public function calculateAndCacheActiveUsers()
    {
        // 取得活跃用户表
        $active_users = $this->calculateActiveUsers();
        // 并加以缓存
        $this->cacheActiveUsers($active_users);
    }

    private  function  calculateActiveUsers(){
        $this->calculateTopicScore();
        $this->calculateReplyScore();

        // 数组按照得分排序
        $users =array_sort($this->users,function ($user){
            return $user['score'];
        });

        // 分数倒序,高分靠前,第二个参数保持数组的 key 不变
        $users = array_reverse($users,true);

        // 只获取我们想要的数量
        $users = array_slice($users,0,$this->user_number,true);

        // 新建一个空集合

        $active_users = collect();
        foreach($users as $user_id =>$user){
            // 找寻是否可以找到用户
            $user = $this->find($user_id);
            if($user){
                // 将此用户实体放置集合末尾
                $active_users->push($user);
            }
        }
        // 返回数据
        return $active_users;
    }

    private function calculateTopicScore()
    {
        // 从话题数据表中取出限定时间 ($pass_day) 内,有发表过话题的用户
        // 并且同时取出此段时间发布话题的数量
        $topic_users = Topic::query()->select(DB::raw('user_id,count(*) as topic_count'))
                                    ->where('created_at','>=',Carbon::now()->subDay($this->pass_day))
                                    ->groupBy('user_id')
                                    ->get();

        // 根据话题数量计算得分
        foreach ($topic_users as $value){
            $this->users[$value->user_id]['score'] =$value->topic_count * $this->topic_weight;
        }
    }

    private  function calculateReplyScore(){
        $reply_users = Reply::query()->select(DB::raw('user_id,count(*) as topic_count'))
            ->where('created_at','>=',Carbon::now()->subDay($this->pass_day))
            ->groupBy('user_id')
            ->get();
        // 根据回复计算得分
        foreach($reply_users as $value){
            $reply_score = $value->reply_count * $this->reply_weight;
            if (isset($this->users[$value->user_id])){
                $this->users[$value->user_id]['score'] += $reply_score;
            }else{
                $this->users[$value->user_id]['score']  = $reply_score;
            }
        }
    }

    private function cacheActiveUsers($active_users){
        // 将数据存入缓存中
        Cache::put($this->catch_key,$active_users,$this->catch_expire_in_minutes);
    }
}
