<?php


namespace App\controllers;


use App\components\Database;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

class ProfileController
{
    private $view;
    private $database;
    private $flash;

    public function __construct(Engine $view, Database $database, Flash $flash)
    {
        $this->view = $view;
        $this->database = $database;
        $this->flash = $flash;
    }

    public function index()
    {
        echo "Вы вошли";
        var_dump($_SESSION['user']);
    }
}