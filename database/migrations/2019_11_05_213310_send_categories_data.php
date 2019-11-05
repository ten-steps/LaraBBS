<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SendCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name' => '分享',
                'description' => '分享创造，分享发现',
            ],
            [
                'name' => '教程',
                'description'=>'开发技巧，拓展包等'
            ],
            [
                'name'=>'问答',
                'description'=>'保持友善，互相帮助'
            ],
            [
                'name'=>'公告',
                'description'=>'站点公告'
            ]
        ];
        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
