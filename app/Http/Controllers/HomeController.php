<?php


namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        $yo = new LoginController();
        $yo->handleProviderCallback();
//        request()->session()->put("yo", "yoyo");
    }
}
