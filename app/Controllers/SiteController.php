<?php


namespace App\Controllers;

use Laminas\Diactoros\ServerRequest;

class SiteController
{

    function index(ServerRequest $request) {
        return view('index');
    }

}
