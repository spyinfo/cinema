<?php

namespace App\controllers\admin;

use App\components\Database;

class APIController extends Controller
{
    private $database;

    public function __construct(Database $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    public function getHalls($id)
    {
        $halls = $this->database->getAllCondition("halls", "id_cinema", $id);
        echo json_encode($halls);
    }

}