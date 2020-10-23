<?php


namespace App\Http\Helpers;

use LaravelRestcord\Discord\Bots\HandlesBotAddedToGuild;
use Illuminate\Http\RedirectResponse;
use LaravelRestcord\Discord\Guild;

class BotAddedToDiscordGuild
{
    use HandlesBotAddedToGuild;

    public function botAdded(Guild $guild) : RedirectResponse
    {
        // do something with the guild information the bot was added to
        echo "<script>alert('yo')</script>";
        return redirect('/yo');
    }

    public function botNotAdded(string $error): RedirectResponse
    {
        // TODO: Implement botNotAdded() method.
        echo "<script>alert('yoyo')</script>";
    }
}

