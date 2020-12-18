<?php


namespace App\Http\Helpers;

use GuzzleHttp\Command\Exception\CommandClientException;
use LaravelRestcord\Discord;
use LaravelRestcord\Discord\ApiClient;

class DiscordUtils
{
    private static $clientGuilds = null;

    public static function getClientGuilds()
    {
        if (is_null(DiscordUtils::$clientGuilds))
        {
            $apiclient = app(ApiClient::class);
            $discord = new Discord($apiclient);
            DiscordUtils::$clientGuilds = $discord->guilds();
        }
        return DiscordUtils::$clientGuilds;
    }

    /**
     * Check if the bot is in the specified guild with id
     * @param $guildId
     * @return bool
     */
    public static function isBotInGuild($guildId)
    {
        $guilds = collect(app('DiscordClient')->user->getCurrentUserGuilds());
        return $guilds->map(function ($guild) {
            return $guild->id;
        })->contains($guildId);
    }

    /**
     * Check if the bot is in the specified guild with id
     * @param $guildsId
     * @return array
     */
    public static function isBotInGuilds($guildsId)
    {
        $guilds = collect(app('DiscordClient')->user->getCurrentUserGuilds());
        return $inGuildList = $guilds->map(function ($guild) {
            return $guild->id;
        })->intersect($guildsId)->all();
    }

    /**
     * Add roles to members
     * @param $guildId
     * @param $usersId
     * @param $rolesId
     * @return array
     */
    public static function addGuildMembersRoles($guildId, $usersId, $rolesId)
    {
        $results = [];
        foreach ($usersId as $userId) {
            foreach ($rolesId as $roleId) {
                try {
                    app('DiscordClient')->guild->addGuildMemberRole(['guild.id' => intval($guildId), 'user.id' => intval($userId), 'role.id' => intval($roleId)]);
                }
                catch (CommandClientException $exception) {
                    $results[$userId] = self::handleDiscordException($exception);
                }
            }
        }
        return $results;
    }

    /**
     * Remove roles to members
     * @param $guildId
     * @param $usersId
     * @param $rolesId
     * @return array
     */
    public static function removeGuildMembersRoles($guildId, $usersId, $rolesId)
    {
        $results = [];
        foreach ($usersId as $userId) {
            foreach ($rolesId as $roleId) {
                try {
                    app('DiscordClient')->guild->removeGuildMemberRole(['guild.id' => intval($guildId), 'user.id' => intval($userId), 'role.id' => intval($roleId)]);
                } catch (CommandClientException $exception) {
                    $results[$userId] = self::handleDiscordException($exception);
                }
            }
        }

        return $results;
    }

    /**
     * @param $guildId
     * @param $usersId
     * @return array
     */
    public static function removeGuildMembers($guildId, $usersId)
    {
        $results = [];
        foreach ($usersId as $userId) {
            try {
                app('DiscordClient')->guild->removeGuildMember(['guild.id' => intval($guildId), 'user.id' => intval($userId)]);
            } catch (CommandClientException $exception) {
                $results[$userId] = self::handleDiscordException($exception);
            }
        }
        return $results;

    }

    /**
     * @param $guildId
     * @param $usersId
     * @param string $reason
     * @param int $deleteMessageDays
     * @deprecated Problem with Restcord api
     */
    public static function createGuildBans($guildId, $usersId, $reason = "", $deleteMessageDays = 0)
    {
        foreach ($usersId as $userId) {
            app('DiscordClient')->guild->createGuildBan(['guild.id' => $guildId, 'user.id' => $userId, 'reason' => $reason, 'delete_message_days' => $deleteMessageDays]);
        }

    }

    /**
     * @param $guildId
     * @param $usersId
     * @deprecated Problem with Restcord api
     */
    public static function removeGuildBans($guildId, $usersId)
    {
        foreach ($usersId as $userId) {
            dd(app('DiscordClient')->guild->removeGuildBan(['guild.id' => $guildId, 'user.id' => $userId]));
        }
    }


    public static function listWorkableRoles($guildId)
    {
        $botId = app('DiscordClient')->user->getCurrentUser()->id;
        $botRoles = app('DiscordClient')->guild->getGuildMember(['guild.id' => $guildId, 'user.id' => $botId])->roles;
        $roles = collect(app('DiscordClient')->guild->getGuildRoles(['guild.id' => $guildId]));
        $maxBotRolesPosition = $roles->whereIn('id', $botRoles)->max('position');
        $filteredRoles = $roles->where('managed', false)->whereBetween('position', [0, $maxBotRolesPosition-1]);
        return $filteredRoles->skip(1)->all(); //everyone is ALWAYS the first of the list
    }

    public static function handleDiscordException(CommandClientException $exception)
    {
        $code = $exception->getResponse()->getStatusCode();

        $result = [$code => ""];
        switch ($code) {
            case 403:
                $result[$code] = "Vous n'avez pas les permissions de faire cela !";
                break;
            case 401:
                $result[$code] = "Votre session est probablement trop vielle essayez de vous reconnectez.";
                break;
            case 429:
                $result[$code] = "Vous avez trop solicitez l'API discord veuillez resssayez plus tard.";
                break;
            default:
                $result[$code] = "Erreur interne réessayez plus tard ou contactez un administrateur";
        }
        return $result;
    }
}
