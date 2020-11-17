<?php


namespace App\Http\Helpers;

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
     * Add roles to members
     * @param $guildId
     * @param $usersId
     * @param $rolesId
     */
    public static function addGuildMembersRoles($guildId, $usersId, $rolesId)
    {
        foreach ($usersId as $userId) {
            foreach ($rolesId as $roleId) {
                app(DiscordClient::class)->guild->addGuildMemberRole(['guild.id' => $guildId, 'user.id'=>$userId, 'role.id'=>$roleId]);
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
                app(DiscordClient::class)->guild->removeGuildMemberRole(['guild.id' => $guildId, 'user.id'=>$userId, 'role.id'=>$roleId]);
            }
        }
    }

    public static function removeGuildMembers()
    {

    }

    public static function createGuildBans()
    {

    }

    public static function removeGuildBans()
    {

    }
}
