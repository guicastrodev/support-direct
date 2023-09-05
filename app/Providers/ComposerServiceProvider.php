<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if(!is_null(auth()->user())){
                $perfil = auth()->user()->perfil;
                $view->with('perfil', $perfil);
            }
            else{
                $view->with('perfil', null);
            }
        });
    }

    public function register()
    {
    }
}