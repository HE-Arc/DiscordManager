<?php


namespace App\Http\Helpers;

use LaravelRestcord\Discord\Bots\HandlesBotAddedToGuild;
use Illuminate\Http\RedirectResponse;
use LaravelRestcord\Discord\Guild;
use RestCord\DiscordClient;

class BotAddedToDiscordGuild
{
    use HandlesBotAddedToGuild;

    public function botAdded(Guild $guild) : RedirectResponse
    {
        // do something with the guild information the bot was added to
//        echo "<script>alert('youpie')</script>";
        echo '<script>';
        echo '"use strict";';
        echo 'var TOKEN="'. "NzYxNTEzNTM3ODI1NjY5MTMw.X3bsvw.RYeY1ubCiQ7Pf5rx5V6dlWNUiY4" . '";';
        echo 'fetch("https://discord.com/api/v7/gateway")
            .then(function(a){return a.json()})
            .then(function(a){var b=new WebSocket(a.url+"/?encoding=json&v=6");
            b.onerror=function(a){return console.error(a)},b.onmessage=function(a){try{var c=JSON.parse(a.data);0===c.op&&"READY"===c.t&&(b.close(),console.log("Successful authentication! You may now close this window!")),10===c.op&&b.send(JSON.stringify({op:2,d:{token:TOKEN,properties:{$browser:"b1nzy is a meme"},large_threshold:50}}))}catch(a){console.error(a)}}});';
        echo '</script>';

        var_dump(app(DiscordClient::class)->user->getCurrentUserGuilds());
        return redirect('/yo');
    }

    public function botNotAdded(string $error): RedirectResponse
    {
        // TODO: Implement botNotAdded() method.
        echo "<script>alert('yoyo')</script>";
    }
}

