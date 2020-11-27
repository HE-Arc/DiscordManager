<?php


namespace App\Http\Helpers;

use GuzzleHttp\Command\Exception\CommandClientException;
use http\Exception;
use RestCord\DiscordClient;

class DiscordUtils
{
    /**
     * Check if the bot is in the specified guild with id
     * @param $guildId
     * @return bool
     */
    public static function isBotInGuild($guildId)
    {
        $guilds = app(DiscordClient::class)->user->getCurrentUserGuilds();
        foreach ($guilds as $guild) {
            if ($guild->id == $guildId) return true;
        }
        return false;
    }

    /**
     * Check if the bot is in the specified guild with id
     * @param $guildsId
     * @return array
     */
    public static function isBotInGuilds($guildsId)
    {
        $inGuildList = array();
        $guilds = app(DiscordClient::class)->user->getCurrentUserGuilds();
        foreach ($guilds as $guild) {
            foreach ($guildsId as $guildId)
                if ($guild->id == $guildId) array_push($inGuildList, $guild->id);
        }
        return $inGuildList;
    }

    /**
     * Add roles to members
     * @param $guildId
     * @param $usersId
     * @param $rolesId
     */
    public static function addGuildMembersRoles($guildId, $usersId, $rolesId)
    {
        foreach ($usersId as $userId) {
            foreach ($rolesId as $roleId) {
                app(DiscordClient::class)->guild->addGuildMemberRole(['guild.id' => $guildId, 'user.id' => $userId, 'role.id' => $roleId]);
            }
        }
    }

    /**
     * Remove roles to members
     * @param $guildId
     * @param $usersId
     * @param $rolesId
     */
    public static function removeGuildMembersRoles($guildId, $usersId, $rolesId)
    {
        foreach ($usersId as $userId) {
            foreach ($rolesId as $roleId) {
                app(DiscordClient::class)->guild->removeGuildMemberRole(['guild.id' => $guildId, 'user.id' => $userId, 'role.id' => $roleId]);
            }
        }
    }

    /**
     * @param $guildId
     * @param $usersId
     */
    public static function removeGuildMembers($guildId, $usersId)
    {
        foreach ($usersId as $userId) {
            app(DiscordClient::class)->guild->removeGuildMember(['guild.id' => $guildId, 'user.id' => $userId]);
        }
    }

    /**
     * @param $guildId
     * @param $usersId
     * @param string $reason
     * @param int $deleteMessageDays
     */
    public static function createGuildBans($guildId, $usersId, $reason = "", $deleteMessageDays = 0)
    {
        foreach ($usersId as $userId) {
            app(DiscordClient::class)->guild->createGuildBan(['guild.id' => $guildId, 'user.id' => $userId, 'reason'=>$reason, 'delete_message_days' =>$deleteMessageDays]);
        }
    }

    /**
     * @param $guildId
     * @param $usersId
     */
    public static function removeGuildBans($guildId, $usersId)
    {
        foreach ($usersId as $userId) {
            dd(app(DiscordClient::class)->guild->removeGuildBan(['guild.id' => $guildId, 'user.id' => $userId]));
        }
    }

    public static function handleDiscordException(CommandClientException $exception){

    }
}
