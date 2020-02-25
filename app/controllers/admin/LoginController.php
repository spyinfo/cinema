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
        if ($this->check()) {
            header("Location: /profile");
        }
        else {
            echo $this->view->render("login");
//            header("Location: /admin/home");
        }
    }

    public function login()
    {
        $user = $this->database->getRowCondition("users", 'login', $_POST['login']);

        if (($user) && (md5($_POST['password']) == $user->password))
        {
            $_SESSION['user'] = $user;
            header("Location: /profile");
        }
        else
        {
            $this->flash->error("Неверно введён логин или пароль!");
            header("Location: /login");
        }
    }

    public function account()
    {
        echo $this->view->render("account");
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: /login");
    }

    /**
     * Проверяем, пользователь в системе или нет
     *
     * @return bool
     */
    public function check()
    {
        return (isset($_SESSION['user'])) ? true : false;
    }

}