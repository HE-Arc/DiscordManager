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
        $results = [];
        foreach ($usersId as $userId) {
            foreach ($rolesId as $roleId) {
                try {
                    app(DiscordClient::class)->guild->addGuildMemberRole(['guild.id' => $guildId, 'user.id' => $userId, 'role.id' => $roleId]);
                } catch (CommandClientException $exception) {
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
     */
    public static function removeGuildMembersRoles($guildId, $usersId, $rolesId)
    {
        $results = [];
        foreach ($usersId as $userId) {
            foreach ($rolesId as $roleId) {
                try {
                    app(DiscordClient::class)->guild->removeGuildMemberRole(['guild.id' => $guildId, 'user.id' => $userId, 'role.id' => $roleId]);
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
     */
    public static function removeGuildMembers($guildId, $usersId)
    {
        $results = [];
        foreach ($usersId as $userId) {
            try {
                app(DiscordClient::class)->guild->removeGuildMember(['guild.id' => $guildId, 'user.id' => $userId]);
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
            app(DiscordClient::class)->guild->createGuildBan(['guild.id' => $guildId, 'user.id' => $userId, 'reason' => $reason, 'delete_message_days' => $deleteMessageDays]);
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
            dd(app(DiscordClient::class)->guild->removeGuildBan(['guild.id' => $guildId, 'user.id' => $userId]));
        }
    }

    public static function handleDiscordException(CommandClientException $exception)
    {
        $code = $exception->getResponse()->getStatusCode();

        $result = [$code];
        switch ($code) {
            case 403:
                array_push($result, "Vous n'avez pas les permissions de faire cela !");
                break;
            case 401:
                array_push($result, "Votre session est probablement trop vielle essayez de vous reconnectez.");
                break;
            case 429:
                array_push($result, "Vous avez trop solicité l'API discord veuillez resssayer plus tard");
                break;
            case 304:
                array_push($result, "Rien n'a été modifié, c'est problablement déjà bon");
                break;
            default:
                array_push($result, "Erreur interne réessayez plus tard ou contactez un administrateur");
        }
        return $result;
    }
}
