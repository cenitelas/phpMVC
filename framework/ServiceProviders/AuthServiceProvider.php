<?php


namespace App\ServiceProviders;


use App\Kernel\Auth;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{

    /** @var User|null */
    protected $user;
    /** @var Auth|null */
    protected static $auth;

    public function register()
    {
        self::$auth = new Auth($this);
    }

    public function boot()
    {
        $request = $this->kernel->request();
        $cookie = $request->getCookieParams();

        if (!isset($cookie['remember_token']))
            return;

        $token = $cookie['remember_token'];
        $this->user = User::find_by_remember_token($token);
    }

    function user() {
        return $this->user;
    }

    static function auth() {
        return self::$auth;
    }

}
