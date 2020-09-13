<?php


namespace App\Kernel;


use App\Models\User;
use App\ServiceProviders\AuthServiceProvider;

class Auth
{

    /** @var AuthServiceProvider */
    protected $provider;

    public function __construct(AuthServiceProvider $provider)
    {
        $this->provider = $provider;
    }

    /** @return User|null */
    function user() {
        return $this->provider->user();
    }

    function check() {
        return $this->user() != null;
    }

    function guest() {
        return !$this->check();
    }

    function attempt($username, $password) {
        /** @var User $user */
        $user = User::find_by_username($username);

        if (!$user)
            return false;

        if (!Hash::check($password, $user->password))
            return false;

        $token = md5(hexdec(uniqid()));
        $expires = time() + (60 * 60 * 24 * 365);
        setcookie('remember_token', $token, $expires, '/');

        $user->remember_token = $token;
        $user->save();

        return true;
    }

    function logout() {

        if ($this->guest())
            return false;

        $this->user()->remember_token = null;
        $this->user()->save();

        setcookie('remember_token', null, -1, '/');
        return true;
    }

}
