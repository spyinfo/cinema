<?php


namespace App\controllers\admin;


use App\components\Database;
use Helpers;
use League\Plates\Engine;

class CinemaController extends Controller
{
    private $view;
    private $database;

    public function __construct(Engine $view, Database $database)
    {
        parent::__construct();
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
        $this->database->store("cinemas", $_POST);
        header("Location: /admin/cinema");
    }

    public function edit($id)
    {
        $cinema = $this->database->getRow("cinemas", $id);
        echo $this->view->render("admin/cinema/edit", ['cinema' => $cinema]);
    }

    public function update($id)
    {
        $this->database->update("cinemas", $id, $_POST);
        header("Location: /admin/cinema");
    }

    public function delete($id)
    {
        $this->database->delete("cinemas", $id);
        header("Location: /admin/cinema");
    }

    public function halls($id)
    {
        $cinema = $this->database->getRow("cinemas", $id);

        if ($cinema) {
            $halls = $this->database->getAllCondition("halls", "id_cinema", $id);
            echo $this->view->render("admin/cinema/halls/index", [
                'halls' => $halls,
                'cinema' => $cinema
            ]);
        } else {
            Helpers::abort(404);
        }
    }

    public function createHall($id)
    {
        $cinema = $this->database->getRow("cinemas", $id);

        if ($cinema) {
            echo $this->view->render("admin/cinema/halls/create", ['cinema' => $cinema]);
        } else {
            Helpers::abort(404);
        }
    }

    public function storeHall($id)
    {
        echo $this->view->render("admin/cinema/halls/createPlace", [
            'rows' => $_POST['count_of_row'],
            'name' => $_POST['name'],
            'cinema' => $_POST['cinema']
        ]);
    }

    public function storeHallPlaces()
    {
        $lastHall = $this->database->getFirstLastRow("halls", true);

        $dataHall = [
            'id' => $lastHall->id + 1,
            'name' => $_POST['name'],
            'id_cinema' => $_POST['cinema'],
            'count_of_row' => $_POST['count_of_row']
        ];
        $this->database->store("halls", $dataHall);

        unset($_POST['name'], $_POST['cinema'], $_POST['count_of_row']);

        foreach ($_POST as $key => $value) {
            $dataRow = [
                'id_hall' => $dataHall['id'],
                'id_row' => $key,
                'start_place' => '1',
                'finish_place' => $value
            ];
            $this->database->store("rows", $dataRow);
        }

        foreach ($_POST as $key => $value) {
            for ($i = 1; $i <= $value; $i++) {
                $dataPlace = [
                    'id_place' => $i,
                    'id_hall' => $dataHall['id'],
                    'id_row' => $key
                ];
                $this->database->store("places", $dataPlace);
            }
        }
        header("Location: /admin/cinema");
    }

    public function showHall($id_cinema, $id_hall)
    {
        $cinemaAndHall = $this->database->getCinemaWithHalls($id_cinema, $id_hall);

        if ($cinemaAndHall) {
            $rows = $this->database->getAllCondition("rows", "id_hall", $id_hall);

            echo $this->view->render("admin/cinema/halls/show", [
                'cinemaAndHall' => $cinemaAndHall,
                'rows' => $rows
            ]);
        } else {
            Helpers::abort(404);
        }
    }
}