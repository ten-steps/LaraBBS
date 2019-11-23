<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements  MustVerifyEmail
{
    use MustVerifyEmailTrait;
    use Notifiable{
        notify as protected laravelNotify;
    }
    use HasRoles;
    use Traits\ActiveUserHelper;
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        if (strlen($value) != 60){
            $value = bcrypt($value);
        }
        $this->attributes['password'] =$value;
    }

    public function setAvatarAttribute($path)
    {
        // 如果不是以http 开头，那就是后台上传的 ，需要补全uri
        if (!starts_with($path,'http')){
            // 拼接完整的url
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }
        $this->attributes['avatar'] = $path;
    }
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }


    public function notify($instance)
    {
        if($this->id == Auth::id()){
            return;
        }

        if (method_exists($instance,'toDatabase')) {
            $this->increment('notification_count');
        }
        $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}
