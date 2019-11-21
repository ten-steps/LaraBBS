<?php

use App\Models\Topic;

return [
    'title' => '话题',
    'single' => '话题',
    'model' => Topic::class,
    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'title' => [
            'name' => '话题',
            'sortable' => false,
            'output' => function ($value, $model) {
                return '<div style="max-width: 260px">' . model_admin_link($value, $model) . '</div>';
            }
        ],
        'user' => [
            'title' => '作者',
            'sortable' => false,
            'output' => function ($value, $model) {
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="' . $avatar . '" alt="" style="height:22px;width:22px;">';
                return model_link($value, $model->user);
            }
        ],
        'reply_count' => [
            'title' => '评论'
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title' => '标题'
        ],
        'user' => [
            'title' => '用户',
            'type' => 'relationship',
            'name_field' => 'name',
            //自动补全,对于大数据量的对应关系,建议开启,
            //可防止一次性加载对系统造成的负担
            'autocomplete' => true,
            //自动补全的搜索字段
            'search_field' => ["CONCAT(id,'',name)"],
            // 自动补全排序
            'options_sort_field' => 'id',
        ],
        'category' => [
            'title' => '分类',
            'type' => 'relationship',
            'name_field' => 'name',
            'search_field' => ["CONCAT(id,'',name)"],
            'options_sort_field' => 'id',
        ],
        'reply_count' => [
            'title' => '评论',
        ],
        'view_count' => [
            'title' => '查看',
        ],
    ],
    'filter' => [
        'id' => [
            'title' => '内容ID',
        ],
        'user' => [
            'title' => '用户',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => ["CONCAT(id,'',name)"],
            'options_sort_field' => 'id',
        ],
        'category'=>[
            'title'=>'分类',
            'type'=>'relationship',
            'name_field'=>'name',
            'search_fields'=>["CONCAT(id,'',name)"],
            'options_sort_field' => 'id',
        ]
    ],
    'rules'=>[
        'title'=>'required',
    ],
    'messages'=>[
        'title.required'=>'请填写标题'
    ]
];
