<?php


namespace App\controllers;


use App\components\Database;
use App\components\Roles;
use Helpers;
use League\Plates\Engine;
use Mobile_Detect;
use Tamtamchik\SimpleFlash\Flash;

class RegisterController extends Controller
{
    private $view;
    private $database;
    private $flash;
    private $detect;

    public function __construct(Engine $view, Database $database, Flash $flash,  Mobile_Detect $detect)
    {
        $this->view = $view;
        $this->database = $database;
        $this->flash = $flash;
        $this->detect = $detect;
        parent::__construct($this->detect);

        if (Roles::getRole()) {
            Helpers::abort(404);
        }
    }

    public function home()
    {
        echo $this->view->render("register");
    }

    public function store()
    {
        $data = [
            'login' => $_POST['login'],
            'password' => md5($_POST['password']),
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'id_role' => Roles::USER
        ];
        $this->database->store("users", $data);
        $this->flash->success("Вы успешно зарегистрировались!<br>Теперь можете войти под своим аккаунтом!");
        header("Location: /login");
    }

}
