<?php


namespace App\Controllers;


use App\Kernel\Hash;
use App\Models\User;
use Laminas\Diactoros\ServerRequest;

class AuthController
{

    function register(ServerRequest $request) {

        if (auth()->check())
            return redirect('/');

        $method = strtolower($request->getMethod());

        if ($method == 'get')
            return view('auth/register', [
                'title' => 'Регистрация'
            ]);

        // Регистрация пользователя
        $data = $request->getParsedBody();
        $data = array_filter($data, function ($item) {
            return $item != null || $item != '';
        });

        if (!isset($data['username']) || !isset($data['password']))
            return redirect('/register');

        if (User::find_by_username($data['username']))
            return redirect('/register');

        $user = new User();
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->save();

        auth()->attempt($data['username'], $data['password']);

        return redirect('/');
    }

    function login(ServerRequest $request) {

        if (auth()->check())
            return redirect('/');

        $method = strtolower($request->getMethod());

        if ($method == 'get')
            return view('auth/login', [
                'title' => 'Войти'
            ]);

        $data = $request->getParsedBody();
        $data = array_filter($data, function ($item) {
            return $item != null || $item != '';
        });

        if (!isset($data['username']) || !isset($data['password']))
            return redirect('/login');

        if (!auth()->attempt($data['username'], $data['password']))
            return redirect('/login');

        return redirect('/');
    }

    function logout() {
        auth()->logout();
        return redirect('/');
    }

}
