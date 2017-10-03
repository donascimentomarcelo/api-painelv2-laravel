<?php

namespace Painel\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Usar o  php artisan make:provider RepositoryServiceProvider para criar o provider

        // dps tem q registrar o esse provider em app.php
            $this->app->bind(
                "Painel\Repositories\UserRepository",
                "Painel\Repositories\UserRepositoryEloquent"
            );
            $this->app->bind(
                "Painel\Repositories\ProjectsRepository",
                "Painel\Repositories\ProjectsRepositoryEloquent"
            );
            $this->app->bind(
                "Painel\Repositories\UploadsRepository",
                "Painel\Repositories\UploadsRepositoryEloquent"
            );
            $this->app->bind(
                "Painel\Repositories\EmailRepository",
                "Painel\Repositories\EmailRepositoryEloquent"
            );
            $this->app->bind(
                "Painel\Repositories\NewsRepository",
                "Painel\Repositories\NewsRepositoryEloquent"
            );
            $this->app->bind(
                "Painel\Repositories\PromotionsRepository",
                "Painel\Repositories\PromotionsRepositoryEloquent"
            );
            $this->app->bind(
                "Painel\Repositories\UploadspromotionsRepository",
                "Painel\Repositories\UploadspromotionsRepositoryEloquent"
            );
    }
}