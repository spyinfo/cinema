<?php


namespace App\controllers\admin;


use App\components\Database;
use League\Plates\Engine;

class FilmController
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
        $films = $this->database->getAll("films");
        echo $this->view->render("admin/film/index", ['films' => $films]);
    }

    public function create()
    {
        echo $this->view->render("admin/film/create");
    }

    public function store()
    {
        $file = file_get_contents($_FILES["image"]["tmp_name"]);
        $data = [
            "name" => $_POST['name'],
            "id_category" => $_POST['id_category'],
            "annotation" => $_POST['annotation'],
            "length" => $_POST['length'],
            "image" => $file
        ];

        $this->database->store("films", $data);
        header("Location: /admin/film");

//        $this->database->update("films", 1, $data);
    }

}