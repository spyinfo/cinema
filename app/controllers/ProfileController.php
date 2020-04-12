<?php


namespace App\controllers;


use App\components\Database;
use App\components\Roles;
use Helpers;
use League\Plates\Engine;
use Mobile_Detect;
use Tamtamchik\SimpleFlash\Flash;

class ProfileController extends Controller
{
    private $view;
    private $database;
    private $flash;
    private $detect;

    public function __construct(Engine $view, Database $database, Flash $flash, Mobile_Detect $detect)
    {
        $this->view = $view;
        $this->database = $database;
        $this->flash = $flash;
        $this->detect = $detect;
        parent::__construct($this->detect);

        if (!Roles::getRole()) {
            Helpers::abort(404);
        }
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
        $sessionInfo = $this->database->getRow("getsessionwithfilmandhall", $_GET['session']);
        $places = $this->database->getRow2Condition("tickets", "id_session", $sessionInfo->id, "login", $login);

        echo $this->view->render("profile/ticket", [
            'sessionInfo' => $sessionInfo,
            'places' => $places
        ]);
    }
}
