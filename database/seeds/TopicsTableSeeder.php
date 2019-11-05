<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        //所有用户ID数组
        $user_ids = User::all()->pluck('id')->toArray();

        //所有的分类ID组
        $category_ids = Category::all()->pluck('id')->toArray();

        //获取Faker实例
        $faker = app(Faker\Generator::class);
        $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) use ($user_ids,$category_ids,$faker) {
//            if ($index == 0) {
//                // $topic->field = 'value';
//            }
            $topic->user_id = $faker->randomElement($user_ids);
            $topic->category_id = $faker->randomElement($category_ids);
        });

        Topic::insert($topics->toArray());
    }

}

