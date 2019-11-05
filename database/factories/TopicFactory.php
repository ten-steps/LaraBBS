<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;


$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        // 'name' => $faker->name,
        'title'=>$faker->title,
        'body'=>$faker->text(),
        'excerpt'=>$sentence,
        'created_at'=>$created_at,
        'updated_at'=>$updated_at,
    ];
});
