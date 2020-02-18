<?php

namespace App\controllers\admin;


use App\components\Database;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

class LoginController {

    private $database;
    private $view;
    private $flash;

    public function __construct(Engine $view, Database $database, Flash $flash)
    {
        $this->view = $view;
        $this->database = $database;
        $this->flash = $flash;
    }

    public function index()
    {
//        if ($this->check()) {
//            header("Location: /admin/home");
//        }
//        else {
//            echo $this->view->render("admin/login");
//        }
        header("Location: /admin/home");
    }

}