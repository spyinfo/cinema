<?php

namespace App\controllers\admin;


use App\components\Database;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

class StatisticController extends Controller
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
        $statistics = $this->database->getAll("getstatistic");
        echo $this->view->render("admin/statistic/index", ['statistics' => $statistics]);
    }
}
