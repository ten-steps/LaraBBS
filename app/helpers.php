<?php

use Illuminate\Support\Facades\Route;

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}

function make_excerpt($value, $lenget = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $lenget);
}
function model_admin_link($title,$model){
    return model_link($title,$model,'admin');
}

function model_link($title, $model, $prefix = '')
{
    $model_name = model_plural_name($model);

    $prefix = $prefix ? "/{$prefix}/" : "/";

    $url = config("app.url") . $prefix . $model_name . '/' . $model->id;

    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}

function model_plural_name($model)
{
    $full_class_name = get_class($model);
    $class_name = class_basename($full_class_name);
    $snake_case_name = snake_case($class_name);
    return str_plural($snake_case_name);

}
