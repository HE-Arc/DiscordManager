<?php


namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use LaravelRestcord\Authentication\Socialite\DiscordProvider;
use LaravelRestcord\Discord;
use LaravelRestcord\ServiceProvider;
use RestCord\DiscordClient;

class LoginController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        echo "Logging in with discord using Socialite";
        return Socialite::driver('discord')->scopes(['guilds'] )->redirect();
    }

    public function loginCallback()
    {
//        dd(Socialite::driver('discord')->user());
        $userSocial = Socialite::driver('discord')->user();

        $user = \App\Models\User::firstOrCreate([
            'email' => $userSocial->email
        ],
        [
            'discord_id' => $userSocial->id,
            'name' => $userSocial->name,
            'image' => $userSocial->avatar,
            'token' => $userSocial->token,
            'refresh_token' => $userSocial->refreshToken,
        ]);

        Auth::login($user,true);
//        DiscordProvider::$token = Socialite::driver('discord')->user()->token;
//        event(new Login("bidon", null,false));

        return redirect()->route("home");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $apiclient = app(Discord\ApiClient::class);
        $discord = new Discord($apiclient);
        $guilds = $discord->guilds();

//        dd($guilds);

        foreach ($guilds as $guild) {
            if ($guild->id == 495147403683299330){
                $guild->sendUserToDiscordToAddBot(Discord\Permissions\Permission::ADMINISTRATOR, $guild->id);
            }
        }
    }

    public function addBot($id)
    {
        $apiclient = app(Discord\ApiClient::class);
        $discord = new Discord($apiclient);
        $guilds = $discord->guilds();

        foreach ($guilds as $guild) {
            if ($guild->id == $id){
                $guild->sendUserToDiscordToAddBot(Discord\Permissions\Permission::ADMINISTRATOR, $guild->id);
            }
        }
    }

    public function handleBotCallback(){
        if (isset($_GET['error'])){
            app(Discord\Bots\HandlesBotAddedToGuild::class)->botNotAdded($_GET['error']);
        }else{
//            echo "<script>alert('yo2')</script>";
//            echo '<script>';
//            echo '"use strict";';
//            echo 'var TOKEN="'. $_GET['code'] . '";';
//            echo 'fetch("https://discord.com/api/v7/gateway")
//            .then(function(a){return a.json()})
//            .then(function(a){var b=new WebSocket(a.url+"/?encoding=json&v=6");
//            b.onerror=function(a){return console.error(a)},b.onmessage=function(a){try{var c=JSON.parse(a.data);0===c.op&&"READY"===c.t&&(b.close(),console.log("Successful authentication! You may now close this window!")),10===c.op&&b.send(JSON.stringify({op:2,d:{token:TOKEN,properties:{$browser:"b1nzy is a meme"},large_threshold:50}}))}catch(a){console.error(a)}}});';
//            echo 'alert("yo3")';
//            $discord = app(DiscordClient::class);
            $apiclient = app(Discord\ApiClient::class);
            $discord = new Discord($apiclient);
            foreach ($discord->guilds() as $guild){
                if ($guild->id == intval($_GET['guild_id'])){
                    app(Discord\Bots\HandlesBotAddedToGuild::class)->botAdded($guild);
                }
            }

//            echo '</script>';
//            echo $_GET['code'];
            //app(DiscordClient::class)->guild->createGuildRole(['guild.id' => intval($_GET['guild_id']), 'name'=>'yorole']);
        }
    }
}
