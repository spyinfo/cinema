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
        $films = $this->database->getRow("films", 1);
        echo $this->view->render("home", ['films' => $films]);
    }

    public function film($id)
    {
//        var_dump($_GET);
        $film = $this->database->getRow("films", $id);
//        var_dump($film);

        if ($_GET) {
            $session = $this->database->getSession($film->id, $_GET['date'], $_GET['time']);
            $cinema = $this->database->getRowCondition("cinemas", "name", $_GET['cinema']);
            $rows = $this->database->getAllCondition("rows", "id_hall", $session->id_hall);
            $hall = $this->database->getRow("halls", $session->id_hall);
            $places = $this->database->getAllCondition("places", "id_hall", $session->id_hall);
            var_dump("session", $session);
            var_dump("cinema", $cinema);
            var_dump("rows", $rows);
            var_dump("hall", $hall);
            var_dump("places", $places);
            echo $this->view->render("session", [
                'cinema' => $cinema,
                'film' => $film,
                'rows' => $rows,
                'hall' => $hall
            ]);
        } else {
            $cinemas = $this->database->getCinemaWhereExistFilms($id);

            echo $this->view->render("film", [
                'film' => $film,
                'cinemas' => $cinemas
            ]);
        }
    }

    // TODO удалить потом
//    public function test()
//    {
//        $file = file_get_contents($_FILES["file"]["tmp_name"]);
//        $data = ["image" => $file];
//        $this->database->update("films", 1, $data);
//    }
}