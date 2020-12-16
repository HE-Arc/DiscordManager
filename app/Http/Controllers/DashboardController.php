<?php

namespace App\Http\Controllers;


use App\Http\Helpers\DiscordUtils;
use Illuminate\Http\Request;
use LaravelRestcord\Discord;
use LaravelRestcord\Discord\ApiClient;
use phpDocumentor\Reflection\Types\Integer;
use RestCord\DiscordClient;
use function PHPUnit\Framework\isEmpty;

class DashboardController extends Controller
{
    //Affiche la page listant les serveurs (anciennement home)
    public function servers()
    {
        $apiclient = app(ApiClient::class);
        $discord = new Discord($apiclient);
        $guilds = $discord->guilds();
        $guildPerm = $guilds->filter(function ($guild){
            return $guild->userCan(Discord\Permissions\Permission::ADMINISTRATOR);
        });
        $guildPermId = $guildPerm->map(function ($guild){
            return $guild->id;
        });

        $guildList = DiscordUtils::isBotInGuilds($guildPermId);

        $InGuildList = $guildPerm->whereIn('id', $guildList);
        $NotInGuildList = $guildPerm->whereNotIn('id', $guildList);

        return view('dashboard.servers.index', ["InGuildList"=>$InGuildList,"NotInGuildList"=>$NotInGuildList]);
    }

    public function server($id)
    {
        //TODO variable app(discord)
        $guild = app(DiscordClient::class)->guild->getGuild(['guild.id' => intval($id)]);
        $members = app(DiscordClient::class)->guild->listGuildMembers(['guild.id' => intval($id), 'limit' => 1000]);
        $roles = DiscordUtils::listWorkableRoles(intval($id));

        return view('dashboard.index', ["guild" => $guild, "members" => $members, "roles" => $roles, "pageName" => "Members"]);
        //return view('dashboard.index', ["InGuildList"=>$InGuildList,"NotInGuildList"=>$NotInGuildList]);
    }

    public function update(Request $request)
    {
        if($request->has('action')){
            switch ($request->get('action')) {
                case "addRoles":
                    if($request->has(['rolesId', 'usersId'])) $this->addRoles($request);
                    break;
                case "removeRoles":
                    if($request->has(['rolesId', 'usersId'])) $this->removeRoles($request);
                    break;
                case "kick":
                    $this->kick($request);
                    break;
                default:
            }
        }

    }

    private function addRoles(Request $request)
    {
        $result = DiscordUtils::addGuildMembersRoles(
            $request->get('id'),
            $request->input('usersId'),
            $request->input('rolesId'));
        if(isEmpty($result)) dd($result);
    }

    private function removeRoles(Request $request)
    {
        $result = DiscordUtils::removeGuildMembersRoles(
            $request->get('id'),
            $request->input('usersId'),
            $request->input('rolesId'));
        if(isEmpty($result)) dd($result);
    }

    private function kick(Request $request)
    {
        $result = DiscordUtils::removeGuildMembers(
            $request->id,
            $request->input('usersId'));
        if(!isEmpty($result)) dd($result);
    }

    public function apiTest(){
//        $results = DiscordUtils::removeGuildMembers(495147403683299330, [300392847180562432]);
        $botId = app(DiscordClient::class)->user->getCurrentUser()->id;
        $botMember = DiscordUtils::listAddableRoles(495147403683299330);
        dd($botMember);
    }

}
