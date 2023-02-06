<?php
namespace App\Services;

class HashService
{
    public function getClaveHash($password, $usuario, $cost=10)
    {
        $salt = substr(base64_encode(openssl_random_pseudo_bytes(17)),0,22);
        $salt = str_replace("+",".", $salt);
        $param = '$'.implode('$', array("2y", str_pad($cost, 2, "0", STR_PAD_LEFT), $salt));
        return crypt($password.'|'.$usuario, $param);
    }

    public function VerifyHash($password, $usuario, $hash)
    {
        return crypt($password.'|'.$usuario, $hash) == $hash;
    }

}