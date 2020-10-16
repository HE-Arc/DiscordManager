<?php


namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use LaravelRestcord\Discord;

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
        return Socialite::driver('discord')->scopes('guilds')->redirect();
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

        $guilds = $discord->guilds();

        foreach ($guilds as $guild) {
            $guild->userCan(Discord\Permissions\Permission::ADMINISTRATOR);
            echo"<script language='javascript'>
            alert(";
            echo $user->token;
            echo ")
</script>";
        }


    }
}
