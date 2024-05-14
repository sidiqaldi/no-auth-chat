<?php

namespace App\Providers;

use App\CustomAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
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
        Auth::viaRequest('no-auth', function ($request) {
            if ($user = $request->session()->get('no-auth')) {

                return new CustomAuth($user);
            }
        });

        Broadcast::routes([ 'middleware' => ['auth:broadcasting'] ]);
    }
}
