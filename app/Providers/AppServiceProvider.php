<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('configs'))
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
            view()->share('settings', $confs);
        }

        App::singleton('socials', function () {
            return ['facebook', 'twitter', 'tiktok', 'whatsapp', 'telegram', 'discord', 'instagram', 'youtube'];
        });
        Paginator::useBootstrapFive();
    }
}
