<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query,$order)
    {
        switch ($order){
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentRepluied();
                break;
        }
        //预防N+1 问题
        return $query->with('user','category');
    }

    public function scopeRecentRepluied($query)
    {
        return $query->orderBy('updated_at','desc');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at','desc');
    }
}
