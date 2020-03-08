<?php


namespace App\controllers\admin;


use App\components\Database;
use Helpers;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

class UserController extends Controller
{
    private $view;
    private $database;
    private $flash;

    public function __construct(Engine $view, Database $database, Flash $flash)
    {
        parent::__construct();
        $this->view = $view;
        $this->database = $database;
        $this->flash = $flash;
    }

    public function index()
    {
        $users = $this->database->getAll("getuserswithroles");
        echo $this->view->render("admin/user/index", [
            'users' => $users
        ]);
    }

    public function updateRole($login, $type)
    {
        if ($type != 'raise' && $type != 'lower') Helpers::abort(404);

        $data = [
            'id_role' => ($type) == 'raise' ? 2 : 1
        ];
        $this->database->update("users", $login, $data, 'login');
        header("Location: /admin/user");
    }
}