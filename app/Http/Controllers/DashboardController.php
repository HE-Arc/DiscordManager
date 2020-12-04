<?php
namespace App\Http\Controllers;


use App\Http\Helpers\DiscordUtils;
use LaravelRestcord\Discord;
use LaravelRestcord\Discord\ApiClient;
use phpDocumentor\Reflection\Types\Integer;
use RestCord\DiscordClient;

class DashboardController extends Controller
{
    public function index($id)
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
        $guild =  app(DiscordClient::class)->guild->getGuild(['guild.id'=>intval($id)]);
        return view('dashboard.index',["guild"=>$guild]);
        //return view('dashboard.index', ["InGuildList"=>$InGuildList,"NotInGuildList"=>$NotInGuildList]);
    }
}
