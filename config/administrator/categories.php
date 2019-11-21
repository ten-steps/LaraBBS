<?php

use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

return [
    'title'=>'分类',
    'single'=>'分类',
    'model'=>Topic::class,

    // 对 curd 动作进行单独权限控制,其他动作默认为通过
    'actions_permissions'=>[
        'delete'=>function(){
            return Auth::user()->hasRole('Founder');
        }
    ],
    'columns'=>[
        'id'=>[
            'title'=>'ID'
        ],
        'name'=>[
            'title'=>'名称',
            'sortable'=>false,
        ],
        'description'=>[
            'title'=>'描述',
            'sortable'=>false,
        ],
        'operation'=>[
            'name'=>'管理',
            'sortable'=>false,
        ]
    ],
    'edit_fields'=>[
        'name'=>[
            'title'=>'名称',
        ],
        'description'=>[
            'title'=>'描述',
            'type'=>'textarea'
        ]
    ],
    'filters'=>[
        'id'=>[
            'title'=>'分类ID',
        ],
        'name'=>[
            'title'=>'名称'
        ],
        'description'=>[
            'title'=>'描述'
        ]
    ],
    'rules'=>[
        'name'=>'required|min:1|unique:categories',
    ],

    'massages'=>[
        'name.unique'=>'分类名在数据库里有重复,请选用其他名称',
        'name.required'=>'请确保名字至少一个字符以上'
    ]
 ];
