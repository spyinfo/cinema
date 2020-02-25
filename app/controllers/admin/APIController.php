<?php

namespace App\controllers\admin;

use App\components\Database;

class APIController
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getHalls($id)
    {
        $halls = $this->database->getAllCondition("halls", "id_cinema", $id);
        echo json_encode($halls);
    }

}