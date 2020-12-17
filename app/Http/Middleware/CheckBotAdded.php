<?php

namespace App\Http\Middleware;

use App\Http\Helpers\DiscordUtils;
use App\Models\User;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use LaravelRestcord\Discord;
use LaravelRestcord\Discord\ApiClient;

class CheckBotAdded
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
        $guildID = $request->route()->parameter("id");

        if (!is_null($guildID)) {
            $guildID = intval($guildID);
            try {
                if (DiscordUtils::isBotInGuild($guildID)) {
                    return $next($request);
                }
                throw new \Exception($request->get("\"Discord Manager\" can not manage this server!"));
            } catch (\Exception $e) {
                return redirect()->back()->with(['status' => 'alert-danger', 'status_msg' => $e->getMessage()]);
            }
        }
        return $next($request);
    }
}
