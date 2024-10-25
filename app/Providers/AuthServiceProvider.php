<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; //追記
use App\Models\User; //追記

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //ログインしたユーザーの権限がadminかuserか判定
        //この記述をするとLaravelのミドルウェアでcanミドルウェアを使った認可が可能
        Gate::define('admin',function(User $user){

            //1人が管理者とユーザーの両方の権限を持つ可能性がある
            foreach($user->roles as $role){
                if($role->name == 'admin'){
                    return true;
                }
            }
            return false;
        });
    }
}
