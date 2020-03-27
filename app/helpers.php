<?php /** @noinspection PhpUnhandledExceptionInspection */

use App\components\Database;
use League\Plates\Engine;

class Helpers
{
    private $container;

    public function __construct()
    {
        global $container;
        $this->container = $container;
    }

    /**
     * Getter $container
     *
     * @return \DI\Container
     */
    private function getContainer()
    {
        return $this->container;
    }

    public static function objectArraySearch($array, $index, $value)
    {
        foreach ($array as $arrayInf) {
            if ($arrayInf->{$index} == $value) return $arrayInf;
        }
        return false;
    }

    public static function objectDoubleArraySearch($array, $indexFirst, $valueFirst, $indexSecond, $valueSecond)
    {
        foreach ($array as $arrayInf) {
            if ($arrayInf->{$indexFirst} == $valueFirst && $arrayInf->{$indexSecond} == $valueSecond) return $arrayInf;
        }
        return false;
    }

    public static function getSessionsForFilms($idFilm, $idCinema, $date)
    {
        $pdo = (new Helpers)->getContainer()->get('PDO');
        $database = new Database($pdo);
        return $database->getSessionsForCinema($idFilm, $idCinema, $date);
    }

    public static function abort($type)
    {
        $view = (new Helpers)->getContainer()->get(Engine::class);
        switch ($type) {
            case 404:
                echo $view->render('errors/404');
                break;
            case 405:
                echo $view->render('errors/405');
                break;
            case "MobileTable":
                echo $view->render('errors/MobileTablet');
                break;
            case "Place":
                echo $view->render("errors/place");
                break;
        }
        exit;
    }

    public static function getFinishPlace($id_hall, $id_row)
    {
        $pdo = (new Helpers)->getContainer()->get('PDO');
        $database = new Database($pdo);
        return $database->getRow2Condition("rows", "id_hall", $id_hall, "id_row", $id_row);
    }
}
