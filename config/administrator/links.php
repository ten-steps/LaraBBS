<?php

use App\Models\Link;
use Illuminate\Support\Facades\Auth;

return [
    'title'=>'资源推荐',
    'single'=>'资源推荐',

    'model'=>Link::class,

    // 权限访问判断
    'permission'=>function(){
        return Auth::user()->hasRole('Founder');
    },
    'columns'=>[
        'id'=>[
            'title'=>'ID'
        ],
        'title'=>[
            'title'=>'名称',
            'sortable'=>false,
        ],
        'link'=>[
            'title'=>'链接',
            'sortable'=>false,
        ],
        'operation'=>[
            'title'=>'管理',
            'sortable'=>false,
        ]
    ],
    'edit_fields'=>[
        'title'=>[
            'title'=>'名称',
        ],
        'link'=>[
            'title'=>'链接',
        ]
    ],
    'filters'=>[
        'id'=>[
            'title'=>'标签ID',
        ],
        'title'=>[
            'title'=>'名称'
        ]
    ]
];
