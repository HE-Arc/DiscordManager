<?php

namespace App\Providers;

use App\Http\Helpers\BotAddedToDiscordGuild;
use Illuminate\Support\ServiceProvider;
use LaravelRestcord\Discord\Bots\HandlesBotAddedToGuild;
use RestCord\DiscordClient;

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
        $this->app->singleton('DiscordClient', DiscordClient::class);
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
