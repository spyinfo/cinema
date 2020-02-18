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

    public static function getSessionsForFilms($idFilm, $idCinema)
    {
        $pdo = (new Helpers)->getContainer()->get('PDO');
        $database = new Database($pdo);
        return $database->getSessionsForCinema($idFilm, $idCinema);
    }

    public static function abort($type)
    {
        $view = (new Helpers)->getContainer()->get(Engine::class);
        switch ($type) {
            case 404:
                echo $view->render('errors/404'); exit;
                break;
            case 405:
                echo $view->render('errors/405'); exit;
                break;
        }
    }


}