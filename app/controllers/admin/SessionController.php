<?php


namespace App\controllers\admin;


use App\components\Database;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

class SessionController extends Controller
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
        $sessions = $this->database->getAll("getSessionsWithFilms");
        echo $this->view->render("admin/session/index", ['sessions' => $sessions]);
    }

    public function create()
    {
        $films = $this->database->getAll("films");
        $cinemas = $this->database->getAll("cinemas");

        echo $this->view->render("admin/session/create", [
            'films' => $films,
            'cinemas' => $cinemas
        ]);
    }

    public function store()
    {
        if (count($_POST) != 6) {
            $this->flash->error("Необходимо заполнить все поля!");
            header("Location: /admin/session/create");
        } else {
            $lastSession = $this->database->getFirstLastRow("sessions", true);
            $data = [
                'id' => $lastSession->id + 1,
                'id_film' => $_POST['films'],
                'id_hall' => $_POST['halls'],
                'cost' => $_POST['cost'],
                'date' => $_POST['date'],
                'time' => $_POST['time']
            ];
            $this->database->store("sessions", $data);
            header("Location: /admin/session");
        }
    }

    public function edit($id)
    {
        $films = $this->database->getAll("films");
        $cinemas = $this->database->getAll("cinemas");
        $session = $this->database->getRow("getsessionforedit", $id);
        echo $this->view->render("admin/session/edit", [
            'session' => $session,
            'films' => $films,
            'cinemas' => $cinemas
        ]);
    }

    // TODO: Обновление с выбором зала!
    public function update($id)
    {
        if (count($_POST) != 6) {
            $this->flash->error("Необходимо заполнить все поля!");
            header("Location: /admin/session/" . $id . "/edit");
        } else {
            $data = [
                'id' => $id,
                'id_film' => $_POST['films'],
                'id_hall' => $_POST['halls'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'cost' => $_POST['cost']
            ];
            $this->database->update("sessions", $id, $data);
            header("Location: /admin/session");
        }
    }

    public function delete($id)
    {
        $this->database->delete("sessions", $id);
        header("Location: /admin/session");
    }
}