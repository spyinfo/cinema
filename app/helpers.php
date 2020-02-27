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
                echo $view->render('errors/404');
                break;
            case 405:
                echo $view->render('errors/405');
                break;
            case "MobileTable":
                echo $view->render('errors/MobileTablet');
                break;
        }
        exit;
    }

    public static function generateTicket($length = 8)
    {
        $characters = 'ABCDEFGHIKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}