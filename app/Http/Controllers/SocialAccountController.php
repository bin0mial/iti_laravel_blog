<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SocialAccountController extends Controller
{
    public function show($provider, $nickname){
        $url = null;
        switch ($provider){
            case "github":
                $url = "https://api.github.com/users/$nickname";
                break;
        }
        if($url){
            $response = Http::get($url)->json();
            return view("social.show", ["provider" => $provider, "data"=> $response]);
        }
        else{
            return redirect()->home();
        }
    }
}
