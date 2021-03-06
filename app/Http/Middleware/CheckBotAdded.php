<?php

namespace App\Http\Middleware;

use App\Http\Helpers\DiscordUtils;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

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
                throw new \Exception("\"Discord Manager\" can not manage this server!");
            } catch (\Exception $e) {
//                session()->flash("dontCheckAccess",true);
                return redirect()->back()->with(['status' => 'alert-danger', 'status_msg' => $e->getMessage()]);
            }
        }
        return $next($request);
    }
}
