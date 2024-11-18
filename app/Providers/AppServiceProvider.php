<?php

namespace App\Providers;

use App\Models\Classe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('checkRole', function (string $role) {
            // $user = User::where('id', Auth::user()->id)->first();
            return "<?php if (Auth::check() && Auth::user()->hasRole($role)) : ?>";
        });

        Blade::directive('endCheckRole', function () {
            return "<?php endif ; ?>";
        });

        Gate::define("coach-class", function (User $user , Classe $class) {
            return Auth::user()->id === $class->coach_id ;
        });
    }
}
