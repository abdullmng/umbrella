<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
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
        $configs = Config::all();
        $confs = [];
        foreach ($configs as $config)
        {
            $confs[$config->name] = $config->value;
        }

        App::singleton('settings', function () use ($confs) {
            return $confs;
        });

        App::singleton('socials', function () {
            return ['facebook', 'twitter', 'tiktok', 'whatsapp', 'telegram', 'discord', 'linkedin', 'youtube'];
        });
        view()->share('settings', $confs);
        Paginator::useBootstrapFive();
    }
}
