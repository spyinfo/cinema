<?php

namespace App\controllers;

use App\components\Database;
use League\Plates\Engine;
use \Tamtamchik\SimpleFlash\Flash;

class HomeController
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
//        $films = $this->database->getRow("films", 1);
        $films = $this->database->getAll("films", true);
        echo $this->view->render("home", ['films' => $films]);
    }

    public function film($id)
    {
        $film = $this->database->getRow("films", $id);

        if ($_GET) {
            $session = $this->database->getSession($film->id, $_GET['date'], $_GET['time']);
            $cinema = $this->database->getRowCondition("cinemas", "name", $_GET['cinema']);
            $rows = $this->database->getAllCondition("rows", "id_hall", $session->id_hall);
            $hall = $this->database->getRow("halls", $session->id_hall);
            $tickets = $this->database->getAllCondition("tickets", "id_session", $session->id);
            //            $places = $this->database->getAllCondition("places", "id_hall", $session->id_hall);
//            var_dump("sessions", $session);
//            var_dump("tickets", $tickets);;
//            var_dump("session", $session);
//            var_dump("cinema", $cinema);
//            var_dump("rows", $rows);
            var_dump("hall", $hall);
//            var_dump("places", $places);
            echo $this->view->render("session", [
                'cinema' => $cinema,
                'film' => $film,
                'rows' => $rows,
                'hall' => $hall,
                'session' => $session,
                'tickets' => $tickets
            ]);
        } else {
            $cinemas = $this->database->getCinemaWhereExistFilms($id);

            echo $this->view->render("film", [
                'film' => $film,
                'cinemas' => $cinemas
            ]);
        }
    }

    public function payment($id)
    {
        $cost = $_POST['cost'];
        $session_id = $_POST['session'];
        $hall_id = $_POST['hall'];

        unset($_POST['cost']);
        unset($_POST['session']);
        unset($_POST['hall']);

        $countOfPlaces = count($_POST);
        $total = $countOfPlaces * $cost;

        $places = [];

        foreach ($_POST as $key => $value) {
            array_push($places, explode("-", $key));
        }

        echo $this->view->render("payment", [
            'count' => $countOfPlaces,
            'total' => $total,
            'cost' => $cost,
            'places' => $places,
            'id' => $id,
            'session' => $session_id,
            'hall' => $hall_id
        ]);
    }

    public function ticket()
    {
        $places = [];
        $session = $_POST['session'];
        $hall = $_POST['hall'];

        unset($_POST['session']);
        unset($_POST['hall']);

        foreach ($_POST as $key => $value) {
            array_push($places, explode("-", $key));
//            $this->database->store("tickets", );
        }

        var_dump($places);

        foreach ($places as $place) {
//            var_dump($place);
            $data = [
                "id_session" => $session,
                "id_hall" => $hall,
                "id_place" => $place[1],
                "id_row" => $place[0],
                "login" => "spyinfo"
            ];
            $this->database->store("tickets", $data);
        }

        echo $this->view->render("ticket", [

        ]);
    }

    public function register()
    {
        echo $this->view->render("register");
    }

    public function registerUser()
    {
        var_dump($_POST);
    }
    // TODO удалить потом
//    public function test()
//    {
//        $file = file_get_contents($_FILES["file"]["tmp_name"]);
//        $data = ["image" => $file];
//        $this->database->update("films", 1, $data);
//    }
}