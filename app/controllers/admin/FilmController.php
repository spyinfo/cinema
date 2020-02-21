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
        $films = $this->database->getAll("getFilmsInAdmin");

        echo $this->view->render("admin/film/index", ['films' => $films]);
    }

    public function create()
    {
        $categories = $this->database->getAll("categories");
        echo $this->view->render("admin/film/create", ['categories' => $categories]);
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
    }

    public function delete($id)
    {
        $this->database->delete("films", $id);
        header("Location: /admin/film");
    }

}