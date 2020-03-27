<?php

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

$containerBuilder = new ContainerBuilder;

$containerBuilder->addDefinitions([

    /**
     * @note Система шаблонов PHP
     * @see http://platesphp.com/ - полная документация
     */
    Engine::class => function() {
        return new Engine("../app/views");
    },

    /**
     * @note Отправка писем по электронной почте
     * @see  https://github.com/PHPMailer/PHPMailer - полная документация
     */
    PHPMailer::class => function() {
        return new PHPMailer();
    },

    /**
     * @note Флэш-уведомления
     * @see https://packagist.org/packages/tamtamchik/simple-flash - полная документация
     */
    Flash::class => function() {
        return new Flash();
    },

    PDO::class => function() {
        return new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
    },
]);

$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ["App\controllers\HomeController", "index"]);

    $r->addRoute('GET', '/film/{id}', ["App\controllers\HomeController", "film"]);
    $r->addRoute('POST', '/film/{id}/payment', ["App\controllers\HomeController", "payment"]);
    $r->addRoute('POST', '/film/{id}/ticket', ["App\controllers\HomeController", "ticket"]);

    // Register
    $r->addRoute('GET', '/register', ["App\controllers\RegisterController", "home"]);
    $r->addRoute('POST', '/register/store', ["App\controllers\RegisterController", "store"]);


    $r->addRoute('GET', '/logout', ["App\controllers\admin\LoginController", "logout"]);

    $r->addRoute('GET', '/profile', ["App\controllers\ProfileController", "index"]);
    $r->addRoute('GET', '/profile/orders', ["App\controllers\ProfileController", "orders"]);
    $r->addRoute('GET', '/profile/orders/ticket?{data}', ["App\controllers\ProfileController", "ticket"]);

    // Login
    $r->addGroup('/login', function (RouteCollector $r) {
        $r->addRoute('GET', '', ["App\controllers\admin\LoginController", "index"]);
        $r->addRoute('POST', '/check', ["App\controllers\admin\LoginController", "login"]);

    });

    // API
    $r->addGroup('/api', function (RouteCollector $r) {
        $r->addRoute('GET', '/user/{login}', ["App\controllers\APIController", "isExistLogin"]);
    });

    // Admin
    $r->addGroup('/admin', function (RouteCollector $r) {
        $r->addRoute('GET', '', ["App\controllers\admin\HomeController", "index"]);

        $r->addRoute('GET', '/home', ["App\controllers\admin\HomeController", "home"]);

        // CINEMA
        $r->addRoute('GET', '/cinema', ["App\controllers\admin\CinemaController", "index"]);
        $r->addRoute('GET', '/cinema/create', ["App\controllers\admin\CinemaController", "create"]);
        $r->addRoute('POST', '/cinema/store', ["App\controllers\admin\CinemaController", "store"]);
        $r->addRoute('GET', '/cinema/{id}/edit', ["App\controllers\admin\CinemaController", "edit"]);
        $r->addRoute('POST', '/cinema/{id}/update', ["App\controllers\admin\CinemaController", "update"]);
        $r->addRoute('GET', '/cinema/{id}/delete', ["App\controllers\admin\CinemaController", "delete"]);

        // CINEMA'S HALLS
        $r->addRoute('GET', '/cinema/{id}/halls', ["App\controllers\admin\CinemaController", "halls"]);
        $r->addRoute('GET', '/cinema/{id}/halls/create', ["App\controllers\admin\CinemaController", "createHall"]);
        $r->addRoute('POST', '/cinema/{id}/halls/store', ["App\controllers\admin\CinemaController", "storeHall"]);
        $r->addRoute('POST', '/cinema/{id}/halls/storeHallPlaces', ["App\controllers\admin\CinemaController", "storeHallPlaces"]);
        $r->addRoute('GET', '/cinema/{id_cinema}/halls/{id_hall}', ["App\controllers\admin\CinemaController", "showHall"]);
        $r->addRoute('GET', '/cinema/{id_cinema}/halls/{id_hall}/edit', ["App\controllers\admin\CinemaController", "editHall"]);
        $r->addRoute('POST', '/cinema/{id_cinema}/halls/{id_hall}/update', ["App\controllers\admin\CinemaController", "updateHall"]);
        $r->addRoute('POST', '/cinema/{id_cinema}/halls/{id_hall}/edit-hall-places', ["App\controllers\admin\CinemaController", "editHallPlaces"]);


        // SESSION
        $r->addRoute('GET', '/session', ["App\controllers\admin\SessionController", "index"]);
        $r->addRoute('GET', '/session/create', ["App\controllers\admin\SessionController", "create"]);
        $r->addRoute('POST', '/session/store', ["App\controllers\admin\SessionController", "store"]);
        $r->addRoute('GET', '/session/{id}/edit', ["App\controllers\admin\SessionController", "edit"]);
        $r->addRoute('POST', '/session/{id}/update', ["App\controllers\admin\SessionController", "update"]);
        $r->addRoute('GET', '/session/{id}/delete', ["App\controllers\admin\SessionController", "delete"]);


        // FILM
        $r->addRoute('GET', '/film', ["App\controllers\admin\FilmController", "index"]);
        $r->addRoute('GET', '/film/create', ["App\controllers\admin\FilmController", "create"]);
        $r->addRoute('POST', '/film/store', ["App\controllers\admin\FilmController", "store"]);
        $r->addRoute('GET', '/film/{id}/edit', ["App\controllers\admin\FilmController", "edit"]);
        $r->addRoute('POST', '/film/{id}/update', ["App\controllers\admin\FilmController", "update"]);
        $r->addRoute('GET', '/film/{id}/delete', ["App\controllers\admin\FilmController", "delete"]);

        // USER
        $r->addRoute('GET', '/user', ["App\controllers\admin\UserController", "index"]);
        $r->addRoute('GET', '/user/{login}/{type}', ["App\controllers\admin\UserController", "updateRole"]);

        // STATISTIC
        $r->addRoute('GET', '/statistic', ["App\controllers\admin\StatisticController", "index"]);


        // API
        $r->addRoute('GET', '/api/halls/{id}', ["App\controllers\admin\APIController", "getHalls"]);

    });
});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

//if (false !== $pos = strpos($uri, '?')) {
//    $uri = substr($uri, 0, $pos);
//}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0])
{
    case FastRoute\Dispatcher::NOT_FOUND:
        // Ошибка 404. Страница не найдена
        Helpers::abort(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // Ошибка 405. Метод не разрешен
        Helpers::abort(405);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, $vars);
        break;
}
