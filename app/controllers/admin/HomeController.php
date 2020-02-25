<?php


namespace App\controllers\admin;



use App\components\Database;
use Intervention\Image\ImageManager;
use League\Plates\Engine;

class HomeController extends Controller
{
    private $view;
    private $database;
    private $imageManager;

    public function __construct(Engine $view, Database $database, ImageManager $imageManager)
    {
        parent::__construct();
        $this->view = $view;
        $this->database = $database;
        $this->imageManager = $imageManager;
    }

    public function index()
    {
        header("Location: /admin/home");;
    }

    public function home()
    {
        echo $this->view->render("admin/home");
    }
}