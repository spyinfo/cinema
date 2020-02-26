<?php


namespace App\controllers;


use App\components\Database;
use App\components\Roles;
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
        echo $this->view->render("profile/profile");
    }

    public function orders()
    {
        $login = Roles::getLogin();
        $orders = $this->database->getOrders($login);
        echo $this->view->render("profile/orders", [
            'orders' => $orders
        ]);
    }

    public function ticket()
    {
        $login = Roles::getLogin();
        $sessionInfo = $this->database->getRow("getSessionWithFilmAndHall", $_GET['session']);
        $places = $this->database->getRow2Condition("tickets", "id_session", $sessionInfo->id, "login", $login);

        echo $this->view->render("profile/ticket", [
            'sessionInfo' => $sessionInfo,
            'places' => $places
        ]);
    }
}