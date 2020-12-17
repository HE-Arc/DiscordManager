<?php

namespace App\Http\Middleware;

use App\Http\Helpers\DiscordUtils;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use LaravelRestcord\Discord;
use LaravelRestcord\Discord\ApiClient;
use RestCord\DiscordClient;

class CheckAccessToServer
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
        $apiclient = app(ApiClient::class);
        $discord = new Discord($apiclient);
        $guilds = $discord->guilds();
        DiscordUtils::$clientGuilds = $guilds;
        if (!is_null($guildID)) {
            $guildID = intval($guildID);
            try {
                $guild = $guilds->where("id", $guildID)->first;
                if ($guild->isNotEmpty()) {
                    if ($guild->userCan(Discord\Permissions\Permission::ADMINISTRATOR)) {
                        return $next($request);
                    }
                }
                throw new \Exception($request->get("You can not access this server!"));

            } catch (\Exception $e) {
                return redirect()->back()->with(['status' => 'alert-danger', 'status_msg' => $e->getMessage()]);
            }
        }
        return $next($request);
    }
}
