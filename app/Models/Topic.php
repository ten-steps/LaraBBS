<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
}
