<?php

namespace controllers\tools\account_tools;

function sameHash($hash1, $hash2)
{
    return password_verify($hash1, $hash2);
}

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}
