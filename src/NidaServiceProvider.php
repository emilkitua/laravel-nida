<?php

namespace EmilKitua\Nida;

use Illuminate\Support\ServiceProvider;

class NidaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Nida::class, function () {
            return new Nida();
        });
    }

    public function boot()
    {
        //
    }
}
