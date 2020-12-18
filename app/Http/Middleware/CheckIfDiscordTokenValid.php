<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfDiscordTokenValid
{
    /** @var Session */
    protected $session;

    /** @var Application */
    protected $app;

    public function __construct(Session $session, Application $app)
    {
        $this->session = $session;
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (!$this->session->has('discord_token'))
            {
                $this->session->put('discord_token',Auth::user()->token);
            }

            $user = User::where('discord_id',  Auth::user()->discord_id)->first();

            $datetime1 = strtotime("now");
            $datetime2 = strtotime($user->updated_at);

            //On calcul avec le temps écoulé si le token stocké dans la database est encore valid
            if ($datetime1 - $datetime2 + 600 > intval($user->expires_in))
            {
                //SI pas le cas, requête pour refresh le token à l'aide du refresh_token stocké dans la database
                $httpClient = new Client();

                $response = $httpClient->post('https://discordapp.com/api/oauth2/token', [
                    'headers' => ['Accept' => 'application/json'],
                    'form_params' => [
                        'client_id' => env('DISCORD_KEY', ''),
                        'client_secret' => env('DISCORD_SECRET', ''),
                        'grant_type' => 'refresh_token',
                        'refresh_token' => Auth::user()->refresh_token,
                        'redirect_uri' => env('DISCORD_REDIRECT_URI', ''),
                        'scope' => 'guilds',
                    ],
                ]);

                $decode = json_decode($response->getBody());
                $user->token = $decode->access_token;
                $user->refresh_token = $decode->refresh_token;
                $user->expires_in = $decode->expires_in;
                $user->save();

                Auth::setUser($user);
                $this->session->put('discord_token',$user->token);
            }
        }
        return $next($request);
    }
}
