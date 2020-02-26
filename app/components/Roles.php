<?php


namespace App\components;


final class Roles
{
    const USER = 1;
    const ADMIN = 2;

    public static function getRole()
    {
        return (($_SESSION['user'])) ? ($_SESSION['user']->id_role == Roles::USER ? Roles::USER : Roles::ADMIN ) : false;
    }

    public static function getLogin()
    {
        return (($_SESSION['user'])) ? $_SESSION['user']->login : false;
    }
}