<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            // Compartilhe o perfil do usuário ativo com todas as views
            if(!is_null(auth()->user())){
                $view->with('perfil', auth()->user()->tipo);
            }
            else{
                $view->with('perfil', null);
            }
        });
    }

    public function register()
    {
        //
    }
}