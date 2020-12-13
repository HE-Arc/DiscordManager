<?php


namespace App\Http\Helpers;

use Illuminate\Support\Facades\Session;
use LaravelRestcord\Discord\Bots\HandlesBotAddedToGuild;
use Illuminate\Http\RedirectResponse;
use LaravelRestcord\Discord\Guild;
use RestCord\DiscordClient;

class BotAddedToDiscordGuild
{
    use HandlesBotAddedToGuild;

    public function botAdded(Guild $guild) : RedirectResponse
    {
        return redirect('/yo');
    }

    public function botNotAdded(string $error): RedirectResponse
    {
        // TODO: Implement botNotAdded() method.
        echo "<script>alert('yoyo')</script>";
    }
}

