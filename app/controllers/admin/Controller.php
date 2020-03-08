<?php


namespace App\controllers\admin;

use Helpers;
use App\components\Roles;

class Controller
{
    public function __construct()
    {
        if (($_SESSION['user']->id_role) == Roles::USER || !$_SESSION['user'])
        {
            Helpers::abort(404);
        }
    }
}