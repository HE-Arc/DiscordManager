<?php


namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use LaravelRestcord\Discord;
use LaravelRestcord\ServiceProvider;
use RestCord\DiscordClient;

class LoginController extends Controller
{
<<<<<<< HEAD

=======
>>>>>>> f_dev
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        echo "yoyo";
        return Socialite::driver('discord')->scopes(['guilds'] )->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
<<<<<<< HEAD
        Discord::setCallbackUrl("http://discordmanager.test");
=======
>>>>>>> f_dev
        $user = Socialite::driver('discord')->user();


        $apiclient = new Discord\ApiClient($user->token);
        $discord = new Discord($apiclient);
//        $yo = app(DiscordClient::class);
//        $yo = new DiscordClient(['token'=> $user->token] );
//        var_dump($yo->user->getCurrentUser());
//                echo '<pre>';
//                var_dump($yo);
//                echo '</pre>';
        $guilds = $discord->guilds();


<<<<<<< HEAD

        echo "<script>alert('hello') </script>";

        foreach ($guilds as $guild) {
            if ($guild->id == 495147403683299330){
                $guild->sendUserToDiscordToAddBot(Discord\Permissions\Permission::ADMINISTRATOR);
            }
        }
    }
    public function handleBotCallback(){
        echo "<script>alert('yo')</script>";
        if (isset($_GET['error'])){
            app(Discord\Bots\HandlesBotAddedToGuild::class)->botNotAdded($_GET['error']);
        }else{
            echo "<script>alert('yo2')</script>";
            echo '<script>';
            echo '"use strict";';
            echo 'var TOKEN="'. $_GET['code'] . '";';
            echo 'fetch("https://discord.com/api/v7/gateway")
            .then(function(a){return a.json()})
            .then(function(a){var b=new WebSocket(a.url+"/?encoding=json&v=6");
            b.onerror=function(a){return console.error(a)},b.onmessage=function(a){try{var c=JSON.parse(a.data);0===c.op&&"READY"===c.t&&(b.close(),console.log("Successful authentication! You may now close this window!")),10===c.op&&b.send(JSON.stringify({op:2,d:{token:TOKEN,properties:{$browser:"b1nzy is a meme"},large_threshold:50}}))}catch(a){console.error(a)}}});';
            echo 'alert("yo3")';
            //app(Discord\Bots\HandlesBotAddedToGuild::class)->botAdded($_GET['guild_id']);
            echo '</script>';
            echo $_GET['code'];
        }
=======
        foreach ($guilds as $guild) {
            if ($guild->id == 495147403683299330){
                echo $guild->userCan(Discord\Permissions\Permission::MANAGE_ROLES);
                echo '<pre>';
                var_dump($guild);
                echo '</pre>';
            }

        }



>>>>>>> f_dev
    }
}
