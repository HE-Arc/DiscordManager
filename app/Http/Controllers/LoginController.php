<?php


namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use LaravelRestcord\Discord;
use LaravelRestcord\ServiceProvider;
use Ramsey\Uuid\Guid\Guid;
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
        $this->laravel['config']['laravel-restcord']['bot-token'] = $user->token;

        $guilds = $discord->guilds();
        echo "<pre>";
//        var_dump($guilds);
        echo "</pre>";

        $dc = app(DiscordClient::class);
        echo $user->token;
        echo "<pre>";
        var_dump($dc->guild->getGuild(['guild.id' => 495147403683299330]));
        var_dump($dc->user->getCurrentUser());
        var_dump($dc->user->getUser(['user.id' => 300392847180562432]));
        echo "</pre>";


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
