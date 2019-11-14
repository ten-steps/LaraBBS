<?php

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //所有的用户id
        $user_ids = User::all()->pluck('id')->toArray();
        //所有的文章id
        $topic_ids = Topic::all()->pluck('id')->toArray();
        $facker = app(Faker\Generator::class);
        $replys = factory(Reply::class)->times(1000)->make()->each(function ($reply, $index) use ($user_ids,$topic_ids,$facker) {
            $reply->user_id = $facker->randomElement($user_ids);
            $reply->topic_id = $facker->randomElement($topic_ids);
        });

        Reply::insert($replys->toArray());
    }

}

