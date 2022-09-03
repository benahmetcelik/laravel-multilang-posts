<?php

namespace MultiLangPost;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class MultiLangPostServiceProvider extends ServiceProvider
{
    /**
     * The policies
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     *
     */
    public function boot()
    {
        $this->setupConfig();
        $this->setupMigrations();
        $this->setupModels();
    }



    protected function setupConfig()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'multilang_post');
        $this->publishes([
            __DIR__ . '/../config/multilang_post.php' => config_path('multilang_post.php'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/multilang_post'),
        ]);
    }

    /**
     * Setup the migrations.
     */
    protected function setupMigrations()
    {
        $timestamp = date('Y_m_d_His');
        $migrationsSource[realpath(__DIR__.'/../database/migrations/multilang_langs.php')]=database_path("/migrations/{$timestamp}_multilang_langs.php");
        $migrationsSource[realpath(__DIR__.'/../database/migrations/multilang_posts.php')]=database_path("/migrations/{$timestamp}_multilang_posts.php");
        $migrationsSource[realpath(__DIR__.'/../database/migrations/multilang_settings.php')]=database_path("/migrations/{$timestamp}_multilang_settings.php");
        $this->publishes($migrationsSource, 'migrations');
    }

    /**
     * Setup the models.
     */
    protected function setupModels()
    {

        $migrationsSource[realpath(__DIR__.'/../src/Models/MultiLang/MultiLangLang.php')]=app_path("/Models/MultiLang/MultiLangLang.php");
        $migrationsSource[realpath(__DIR__.'/../src/Models/MultiLang/MultiLangPost.php')]=app_path("/Models/MultiLang/MultiLangPost.php");
        $migrationsSource[realpath(__DIR__.'/../src/Models/MultiLang/MultiLangSeting.php')]=app_path("/Models/MultiLang/MultiLangSeting.php");
      $this->publishes($migrationsSource, 'models');
    }
    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }

}
