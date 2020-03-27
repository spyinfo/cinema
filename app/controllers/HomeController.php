<?php

namespace App\controllers;

use App\components\Database;
use App\components\Roles;
use Helpers;
use League\Plates\Engine;
use Mobile_Detect;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use \Tamtamchik\SimpleFlash\Flash;

class HomeController extends Controller
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
    }

    public function index()
    {
        $films = $this->database->getAll("films", true);
        echo $this->view->render("home", ['films' => $films]);
    }

    public function film($id)
    {
        $film = $this->database->getRow("films", $id);

        if (!$film) Helpers::abort(404);

        if (count($_GET) == 1) {
            $cinemas = $this->database->getCinemaWhereExistFilms($id, $_GET['date']);

            echo $this->view->render("film", [
                'film' => $film,
                'cinemas' => $cinemas,
                'date' => $_GET['date']
            ]);
        } else if (count($_GET) == 4) {
            $session = $this->database->getSession($film->id, $_GET['date'], $_GET['time'], $_GET['hall']);
            $cinema = $this->database->getRowCondition("cinemas", "name", $_GET['cinema']);
            $rows = $this->database->getAllCondition("rows", "id_hall", $_GET['hall']);
            $hall = $this->database->getRow("halls", $_GET['hall']);
            $tickets = $this->database->getAllCondition("tickets", "id_session", $session->id);

            echo $this->view->render("session", [
                'cinema' => $cinema,
                'film' => $film,
                'rows' => $rows,
                'hall' => $hall,
                'session' => $session,
                'tickets' => $tickets
            ]);
        } else Helpers::abort(404);
    }

    public function payment($id)
    {
        $cost = $_POST['cost'];
        $session_id = $_POST['session'];
        $hall_id = $_POST['hall'];

        unset($_POST['cost'], $_POST['session'], $_POST['hall'], $_POST['logged']);

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

        unset($_POST['session'], $_POST['hall'], $_POST['logged-']);


        foreach ($_POST as $key => $value) {
            array_push($places, explode("-", $key));
        }

        foreach ($places as $place) {
            $data = [
                "id_session" => $session,
                "id_hall" => $hall,
                "id_place" => $place[1],
                "id_row" => $place[0],
                "login" => Roles::getLogin(),
            ];

            $isPLaceNotFree = $this->database->isPlacesNotFree($session, $hall, $place[0], $place[1]);
            if ($isPLaceNotFree) Helpers::abort("Place");
        }

        foreach ($places as $place) {
            $data = [
                "id_session" => $session,
                "id_hall" => $hall,
                "id_place" => $place[1],
                "id_row" => $place[0],
                "login" => Roles::getLogin(),
            ];
            $this->database->store("tickets", $data);
        }


        echo $this->view->render("ticket", [
            'sessionInfo' => $sessionInfo,
            'places' => $places,
        ]);
    }
}
