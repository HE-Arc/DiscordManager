<?php


namespace App\Http\Helpers;

use Illuminate\Support\Facades\Session;
use LaravelRestcord\Discord\Bots\HandlesBotAddedToGuild;
use Illuminate\Http\RedirectResponse;
use LaravelRestcord\Discord\Guild;

class BotAddedToDiscordGuild
{
    use HandlesBotAddedToGuild;

    public function botAdded(Guild $guild) : RedirectResponse
    {
        return redirect("/dashboard/".$guild->id)->with(['status'=> 'alert-success','status_msg'=> 'Bot Ajouté!']);
    }

    public function botNotAdded(string $error): RedirectResponse
    {
        return redirect()->back()->with(['status'=> 'alert-danger','status_msg'=> $error]);
    }
}

