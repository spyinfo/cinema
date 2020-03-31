<?php

namespace App\controllers\admin;

use App\components\Database;
use League\Plates\Engine;
use Mobile_Detect;
use Tamtamchik\SimpleFlash\Flash;

class LoginController extends \App\controllers\Controller {

    private $database;
    private $view;
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
        // Добавляем в базу IP-адрес пользователя
        $this->database->store("ip", [
            'ip_address' => $_SERVER['REMOTE_ADDR']
        ]);

        // Берем кол-во попыток входа за последнюю минуту
        $count = $this->database->getCountIP($_SERVER['REMOTE_ADDR']);

        // Если условие не выполняется, то вывыодим сообщение. Иначе идем дальше.
        if ($count->count > 3) {
            $this->flash->error("Вам разрешено только 3 попытки за 1 минуту!<br>Пожалуйста, подождите!");
            header("Location: /login"); exit;
        }

        // Попробуем взять из БД пользвоателя с таким логином. В противном случае вернем false
        $user = $this->database->getRowCondition("users", 'login', $_POST['login']);

        // Если md5(пароль) равно введенному паролю, то логиним пользователя. Иначе выводим сообщение
        if (($user) && (md5($_POST['password']) == $user->password)) {
            $_SESSION['user'] = $user;
            header("Location: /profile");
        } else {
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
