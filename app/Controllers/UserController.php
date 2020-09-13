<?php


namespace App\Controllers;



use App\Models\User;
use Laminas\Diactoros\ServerRequest;
use League\Route\Http\Exception\NotFoundException;

class UserController
{
    function show(ServerRequest $request, array $args){
        $username = urldecode($args['username']);

        if(!$user = User::find_by_username($username))
            throw new NotFoundException();

        return view('user',[
            'user'=>$user
        ]);
    }
}