<?php /** @noinspection PhpUnhandledExceptionInspection */

function getSessionsForFilms($idFilm, $idCinema)
{
    global $container;
    $pdo = $container->get('PDO');
    $database = new \App\components\Database($pdo);
    return $database->getSessionsForCinema($idFilm, $idCinema);
}