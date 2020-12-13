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
        return Socialite::driver('discord')->scopes(['guilds'] )->stateless()->redirect();
    }

    public function loginCallback()
    {
//        dd(Socialite::driver('discord')->user());
        $userSocial = Socialite::driver('discord')->stateless()->user();

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
            $apiclient = app(Discord\ApiClient::class);
            $discord = new Discord($apiclient);
            foreach ($discord->guilds() as $guild){
                if ($guild->id == intval($_GET['guild_id'])){
                    app(Discord\Bots\HandlesBotAddedToGuild::class)->botAdded($guild);
                }
            }
        }
    }
}
