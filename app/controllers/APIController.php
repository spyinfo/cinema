<?php


namespace App\controllers;


use App\components\Database;

class APIController
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function isExistLogin($login)
    {
        $login = $this->database->getRowCondition("users", "login", $login);

        echo ($login) ? "true" : "false";
    }

}