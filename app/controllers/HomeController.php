<?php

namespace App\controllers;

use App\components\Database;
use Helpers;
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

        unset($_POST['cost'], $_POST['session'], $_POST['hall']);

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

    public function ticket($id)
    {
        $places = [];
        $session = $_POST['session'];
        $hall = $_POST['hall'];

        $sessionInfo = $this->database->getRow("getSessionWithFilmAndHall", $session);

        unset($_POST['session'], $_POST['hall']);

        foreach ($_POST as $key => $value) {
            array_push($places, explode("-", $key));
        }

        foreach ($places as $place) {
            $data = [
                "id_session" => $session,
                "id_hall" => $hall,
                "id_place" => $place[1],
                "id_row" => $place[0],
                "login" => "spyinfo",
            ];

            $isPLaceNotFree = $this->database->isPlacesNotFree($session, $hall, $place[0], $place[1]);
            if ($isPLaceNotFree) break;

            $this->database->store("tickets", $data);
        }

        echo $this->view->render("ticket", [
            'sessionInfo' => $sessionInfo,
            'places' => $places,
        ]);
    }
}