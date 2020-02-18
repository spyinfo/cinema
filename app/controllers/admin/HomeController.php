<?php


namespace App\controllers\admin;



use App\components\Database;
use Intervention\Image\ImageManager;
use League\Plates\Engine;

class HomeController
{
    private $view;
    private $database;
    private $imageManager;

    public function __construct(Engine $view, Database $database, ImageManager $imageManager)
    {
        $this->view = $view;
        $this->database = $database;
        $this->imageManager = $imageManager;
    }

    public function home()
    {
        echo $this->view->render("admin/home");
    }
}