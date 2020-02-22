<?php


namespace App\controllers\admin;


use App\components\Database;
use League\Plates\Engine;

class SessionController
{
    private $view;
    private $database;

    public function __construct(Engine $view, Database $database)
    {
        $this->view = $view;
        $this->database = $database;
    }

    public function index()
    {
        $sessions = $this->database->getAll("getSessionsWithFilms");
        echo $this->view->render("admin/session/index", ['sessions' => $sessions]);
    }

    public function create()
    {
        $films = $this->database->getAll("films");
        $cinemas = $this->database->getAll("cinemas");

        echo $this->view->render("admin/session/create", [
            'films' => $films,
            'cinemas' => $cinemas
        ]);
    }

    public function store()
    {
        $lastSession = $this->database->getFirstLastRow("sessions", true);
        $data = [
            'id' => $lastSession->id + 1,
            'id_film' => $_POST['films'],
            'id_hall' => $_POST['halls'],
            'cost' => $_POST['cost'],
            'date' => $_POST['date'],
            'time' => $_POST['time']
        ];

        $this->database->store("sessions", $data);
        header("Location: /admin/session");
    }

    public function getHallsForCinema($id)
    {
        $halls = $this->database->getAllCondition("halls", "id_cinema", $id);
        echo json_encode($halls);
    }
}