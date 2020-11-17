<?php
namespace App\Http\Controllers;


use LaravelRestcord\Discord;
use LaravelRestcord\Discord\ApiClient;

class HomeController extends Controller
{
    public function index()
    {
        $apiclient = app(ApiClient::class);
        $discord = new Discord($apiclient);
        $guilds = $discord->guilds();

//        dd($guilds);

        return view('home.index', ["guilds"=>$guilds]);
    }
}
