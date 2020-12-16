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
        $discordClientGuild = app(DiscordClient::class)->guild;
        $guild = $discordClientGuild->getGuild(['guild.id' => intval($id)]);
        $members = $discordClientGuild->listGuildMembers(['guild.id' => intval($id), 'limit' => 1000]);
        $roles = DiscordUtils::listWorkableRoles(intval($id));

        return view('dashboard.index', ["guild" => $guild, "members" => $members, "roles" => $roles, "pageName" => "Members"]);
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
            $request->id,
            $request->input('usersId'),
            $request->input('rolesId'));
        if(isEmpty($result)) dd($result);
    }

    private function removeRoles(Request $request)
    {
        $result = DiscordUtils::removeGuildMembersRoles(
            $request->id,
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

}
