<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Reply::class => \App\Policies\ReplyPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
		 \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
        \App\Models\User::class =>  \App\Policies\UserPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //是否是站长
        \Horizon::auth(function ($request){
            return  Auth::user()->hasRole('Founder');
        });
        //
    }
}
