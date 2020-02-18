<?php


namespace App\controllers\admin;


use App\components\Database;
use League\Plates\Engine;

class CinemaController
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
        $cinemas = $this->database->getAll("cinemas");
        echo $this->view->render("admin/cinema/index", ['cinemas' => $cinemas]);
    }

    public function create()
    {
        echo $this->view->render("admin/cinema/create");
    }

    public function store()
    {
        var_dump($_POST);
    }
}