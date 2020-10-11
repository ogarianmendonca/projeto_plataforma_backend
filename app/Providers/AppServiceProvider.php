<?php

namespace App\Providers;

use App\Interfaces\PessoaInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UsuarioInterface;
use App\Repositories\PessoaRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UsuarioRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsuarioInterface::class, UsuarioRepository::class);
        $this->app->bind(PessoaInterface::class, PessoaRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
