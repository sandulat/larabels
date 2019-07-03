<?php

namespace Sandulat\Larabels;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class LarabelsApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->authorization();
    }

    /**
     * Configure the Larabels authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();

        Larabels::auth(function ($request) {
            return app()->environment('local') ||
                   Gate::check('viewLarabels', [$request->user()]);
        });
    }

    /**
     * Register the Larabels gate.
     *
     * This gate determines who can access Larabels in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewLarabels', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
