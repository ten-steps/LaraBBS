<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Link extends Model
{
    protected  $fillable = ['title','link'];

    public  $cache_key = 'larabbs_links';

    public $cache_expire_in_minutes = 1440;

    public function getAllCache()
    {
        return Cache::remember($this->cache_key,$this->cache_expire_in_minutes,function (){
            return $this->all();
        });
    }
}
