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
    public function index($id)
    {
        //TODO variable app(discord)
        $guild = app(DiscordClient::class)->guild->getGuild(['guild.id' => intval($id)]);
        $members = app(DiscordClient::class)->guild->listGuildMembers(['guild.id' => intval($id), 'limit' => 1000]);
        $roles = app(DiscordClient::class)->guild->getGuildRoles(['guild.id' => intval($id)]);


        return view('dashboard.index', ["guild" => $guild, "members" => $members, "roles" => $roles]);
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

}
