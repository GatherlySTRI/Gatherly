<?php

namespace tools;

class AccountTools
{
    public static function sameHash($hash1, $hash2)
    {
        return password_verify($hash1, $hash2);
    }

    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
