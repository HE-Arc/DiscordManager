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

    public static function addGuildMembersRoles()
    {

    }

    public static function removeGuildMembersRoles()
    {

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
