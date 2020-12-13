<?php


namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use LaravelRestcord\Authentication\Socialite\DiscordProvider;
use LaravelRestcord\Discord;
use LaravelRestcord\ServiceProvider;
use RestCord\DiscordClient;
use App\Models\User;

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

    public function loginCallback(Request $request)
    {
//        dd(Socialite::driver('discord')->stateless()->user());
        try {
            if ($request->has('code'))
            {
                $userSocial = Socialite::driver('discord')->stateless()->user();
//                dd($userSocial);
//                $user = User::firstOrCreate([
//                    'email' => $userSocial->email
//                ],
//                    [
//                        'discord_id' => $userSocial->id,
//                        'name' => $userSocial->name,
//                        'image' => $userSocial->avatar,
//                        'token' => $userSocial->token,
//                        'refresh_token' => $userSocial->refreshToken,
//                    ]);

                $user = User::firstOrNew([
                    'discord_id' => $userSocial->id
                ]);
                $user->email = $userSocial->email;
                $user->name = $userSocial->name;
                $user->image = $userSocial->avatar;
                $user->token = $userSocial->token;
                $user->refresh_token = $userSocial->refreshToken;
                $user->expires_in = $userSocial->expiresIn;
                $user->save();

                Auth::login($user,true);
                return redirect()->route("home")->with(['status'=> 'alert-success','status_msg'=> 'Connexion réussie !']);
            }
            throw new \Exception($request->get("error_description"));
        }
        catch (\Exception $e)
        {
            return redirect()->route("welcome")->with(['status'=> 'alert-danger','status_msg'=> $e->getMessage()]);
        }
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
