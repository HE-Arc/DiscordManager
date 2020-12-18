<?php


namespace App\Http\Controllers;

use App\Http\Helpers\DiscordUtils;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return Socialite::driver('discord')->scopes(['guilds'] )->stateless()->redirect();
    }

    public function loginCallback(Request $request)
    {
        try {
            if ($request->has('code'))
            {
                $userSocial = Socialite::driver('discord')->stateless()->user();
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
                return redirect()->route("dashboard")->with(['status'=> 'alert-success','status_msg'=> 'Connexion réussie !']);
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
        return redirect()->route("welcome");
    }

    public function addBot($id)
    {
        $guilds = DiscordUtils::getClientGuilds();

        foreach ($guilds as $guild) {
            if ($guild->id == $id){
                $guild->sendUserToDiscordToAddBot(Discord\Permissions\Permission::ADMINISTRATOR, $guild->id);
            }
        }
    }

    public function handleBotCallback(){
        if (isset($_GET['error'])){
            return app(Discord\Bots\HandlesBotAddedToGuild::class)->botNotAdded($_GET['error']);
        }else{
            foreach (DiscordUtils::getClientGuilds() as $guild){
                if ($guild->id == intval($_GET['guild_id'])){
                    return app(Discord\Bots\HandlesBotAddedToGuild::class)->botAdded($guild);
                }
            }
        }
    }
}
