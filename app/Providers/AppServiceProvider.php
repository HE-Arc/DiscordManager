<?php

namespace App\Providers;

use App\Http\Helpers\BotAddedToDiscordGuild;
use Illuminate\Support\ServiceProvider;
use LaravelRestcord\Discord\Bots\HandlesBotAddedToGuild;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(HandlesBotAddedToGuild::class, BotAddedToDiscordGuild::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(HandlesBotAddedToGuild::class, BotAddedToDiscordGuild::class);
    }
}
