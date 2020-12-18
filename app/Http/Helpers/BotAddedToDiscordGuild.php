<?php


namespace App\Http\Helpers;

use Illuminate\Http\RedirectResponse;
use LaravelRestcord\Discord\Bots\HandlesBotAddedToGuild;
use LaravelRestcord\Discord\Guild;

class BotAddedToDiscordGuild
{
    use HandlesBotAddedToGuild;

    /**
     * Redirect to the good page when bot was successfully added
     * @param Guild $guild
     * @return RedirectResponse
     */
    public function botAdded(Guild $guild): RedirectResponse
    {
        return redirect("/dashboard/" . $guild->id)->with(['status' => 'alert-success', 'status_msg' => 'Bot Ajouté!']);
    }

    /**
     * Redirect to the good page when bot was not added
     * @param string $error
     * @return RedirectResponse
     */
    public function botNotAdded(string $error): RedirectResponse
    {
        return redirect()->back()->with(['status' => 'alert-danger', 'status_msg' => $error]);
    }
}

