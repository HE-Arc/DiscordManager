<?php
namespace App\Http\Controllers;


use App\Http\Helpers\DiscordUtils;
use LaravelRestcord\Discord;
use LaravelRestcord\Discord\ApiClient;
use RestCord\DiscordClient;

class DashboardController extends Controller
{
    public function index()
    {
//        $apiclient = app(ApiClient::class);
//        $discord = new Discord($apiclient);
//        $guilds = $discord->guilds();

//        $InGuildList = array_filter($discord->guilds(),function ($guild){
//            return DiscordUtils::isBotInGuild($guild->id);
//        });
//        $NotInGuildList = array_filter($discord->guilds(),function ($guild){
//            return !DiscordUtils::isBotInGuild($guild->id);
//        });
//        $InGuildList = array();
//        $NotInGuildList = array();
//        $botGuilds = app(DiscordClient::class)->user->getCurrentUserGuilds();
/*
        foreach ($guilds as $guild) {
            foreach ($botGuilds as $guildBot) {
                if ($guild->id == $guildBot->id)
                {
                    array_push($InGuildList,$guild);
                    continue;
                }
            }
            array_push($NotInGuildList,$guild);
            continue;

        }*/

        return view('dashboard.index');
        //return view('dashboard.index', ["InGuildList"=>$InGuildList,"NotInGuildList"=>$NotInGuildList]);
    }
}