<?php


namespace App\Kernel;


class Hash
{

    static function make($original) {
        return password_hash($original, PASSWORD_DEFAULT);
    }

    static function check($original, $hash) {
        return password_verify($original, $hash);
    }

}
