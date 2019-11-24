<?php
namespace App\Observers;
use App\Models\User;
class UserObserver
{
    public function saving(User $user)
    {
        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($user->avatar)) {
            $user->avatar = 'http://img5.imgtn.bdimg.com/it/u=1858881657,1091414906&fm=11&gp=0.jpg';
        }
    }
}
