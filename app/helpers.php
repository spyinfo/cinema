<?php /** @noinspection PhpUnhandledExceptionInspection */

use App\components\Database;

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

    public static function getSessionsForFilms($idFilm, $idCinema)
    {
        $pdo = (new Helpers)->getContainer()->get('PDO');
        $database = new Database($pdo);
        return $database->getSessionsForCinema($idFilm, $idCinema);
    }


}