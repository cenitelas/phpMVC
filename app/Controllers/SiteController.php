<?php


namespace App\Controllers;

use Laminas\Diactoros\ServerRequest;

class SiteController
{

    function index(ServerRequest $request) {
        var_dump(route('users.show',['username'=>'username'])); die;
        return view('index');
    }

}
