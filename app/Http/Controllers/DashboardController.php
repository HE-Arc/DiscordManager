<?php

namespace App\Http\Controllers;


use App\Http\Helpers\DiscordUtils;
use Illuminate\Http\Request;
use LaravelRestcord\Discord;
use LaravelRestcord\Discord\ApiClient;
use RestCord\DiscordClient;
use function PHPUnit\Framework\isEmpty;

class DashboardController extends Controller
{
    //Affiche la page listant les serveurs (anciennement home)
    public function servers(Request $request)
    {
        $guilds = DiscordUtils::getClientGuilds();
        $guildPerm = $guilds->filter(function ($guild) {
            return $guild->userCan(Discord\Permissions\Permission::ADMINISTRATOR);
        });
        $guildPermId = $guildPerm->map(function ($guild) {
            return $guild->id;
        });

        $guildList = DiscordUtils::isBotInGuilds($guildPermId);

        $InGuildList = $guildPerm->whereIn('id', $guildList);
        $NotInGuildList = $guildPerm->whereNotIn('id', $guildList);

        return view('dashboard.servers.index', ["InGuildList" => $InGuildList, "NotInGuildList" => $NotInGuildList]);
    }

    public function server($id)
    {
        $discordClientGuild = app('DiscordClient')->guild;
        $guild = $discordClientGuild->getGuild(['guild.id' => intval($id)]);
        $members = $discordClientGuild->listGuildMembers(['guild.id' => intval($id), 'limit' => 1000]);
        $roles = DiscordUtils::listWorkableRoles(intval($id));

        return view('dashboard.index', ["guild" => $guild, "members" => $members, "roles" => $roles, "pageName" => "Members"]);
    }

    public function aboutServer($id)
    {
        $guild = app('DiscordClient')->guild->getGuild(['guild.id' => intval($id)]);
        return view('dashboard.server-info', ["guild" => $guild, "members" => [], "roles" => [], "pageName" => "Server info"]);
    }

    public function update(Request $request)
    {
        $result = [];
        if ($request->has('action')) {
            switch ($request->get('action')) {
                case "addRoles":
                    if ($request->has(['rolesId', 'usersId'])) {
                        $result = $this->addRoles($request->id, $request->input('usersId'), $request->input('rolesId'));
                    }
                    break;
                case "removeRoles":
                    if ($request->has(['rolesId', 'usersId'])) {
                        $result = $this->removeRoles($request->id, $request->input('usersId'), $request->input('rolesId'));
                    }
                    break;
                case "kick":
                    $result = $this->kick($request->id, $request->input('usersId'));
                    break;
            }
        }
        if (!isEmpty($result)) dd($result);
        return redirect()->route('dashboard.server', $request->id);
    }

    private function addRoles($id, $usersId, $rolesId)
    {
        return DiscordUtils::addGuildMembersRoles($id, $usersId, $rolesId);
    }

    private function removeRoles($id, $usersId, $rolesId)
    {
        return DiscordUtils::removeGuildMembersRoles($id, $usersId, $rolesId);
    }

    private function kick($id, $usersId)
    {
        return DiscordUtils::removeGuildMembers($id, $usersId);
    }

}
