<?php


namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
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
        echo "<pre>";
//        var_dump($guilds);
        echo "</pre>";


        foreach ($guilds as $guild) {
            if ($guild->id == 495147403683299330){
                echo $guild->userCan(Discord\Permissions\Permission::MANAGE_ROLES);
                echo '<pre>';
                var_dump($guild);
                echo '</pre>';
            }

        }



    }
}
