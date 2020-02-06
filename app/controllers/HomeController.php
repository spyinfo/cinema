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
        var_dump($_GET);
        if ($_GET) {
            echo $this->view->render("session");
        } else {
            $film = $this->database->getRow("films", $id);
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