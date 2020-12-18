<p align="center"><img src="https://discordmanager.srvz-webapp.he-arc.ch/logo.svg" width="400"></p>
<p align="center"><h1>Discord Manager</h1></p>

## A propos

"Discord Manager" est une application Laravel permettant une gestion simplifié de vos serveurs Discord.

Cette application est réservée aux personnes ayant des droits Administrateurs sur des serveurs Discord.

Contrairement au client Discord, notre application permet en autre l'attribution (ou la révocation) en masse d'un ou plusieurs rôles sur des utilisateurs.
Elle permet aussi d'exclure rapidement et en clic plusieurs membres d'un serveur.

Pour administrer votre serveur, il suffit de vous connecter avec votre compte Discord et d'y ajouter le bot "Discord Manager".

<img src="https://cdn.discordapp.com/attachments/696649991116292106/789297566817976320/unknown.png" width="400">

<img src="https://cdn.discordapp.com/attachments/696649991116292106/789297670053036062/unknown.png" width="400">

## Mise en place

Pour mettre en place l'application sur votre serveur web, il faut tout d'abord créer une nouvelle application et un bot sur le [portail développeur Discord](https://discord.com/developers/applications).

L'application aura besoin de l'identifiant client (DISCORD_KEY) et de la clé secrète de l'application (DISCORD_SECRET).

<img src="https://cdn.discordapp.com/attachments/696649991116292106/789293169908908072/unknown.png" width="400">

Ci-dessous, il est important de renseigner les 3 routes suivantes ("<domain>/", "<domain>/login-callback", "<domain>/discord/bot-added")

<img src="https://cdn.discordapp.com/attachments/696649991116292106/789291958061236274/unknown.png" width="400">

L'application utilisera aussi le token du bot Discord.

<img src="https://cdn.discordapp.com/attachments/696649991116292106/789294045578133544/unknown.png" width="400">

Dans fichier de configuration ".env", ajoutez les lignes suivantes en renseignant les clés correspondantes.

```
DISCORD_BOT_TOKEN="<token>"
DISCORD_KEY="<key>"
DISCORD_SECRET="<secret>"
DISCORD_REDIRECT_URI="<uri>"
```
