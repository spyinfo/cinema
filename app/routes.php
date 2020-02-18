<?php

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

session_start();

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


    $r->addGroup('/admin', function (RouteCollector $r) {
        $r->addRoute('GET', '', ["App\controllers\admin\LoginController", "index"]);

        $r->addRoute('GET', '/home', ["App\controllers\admin\HomeController", "home"]);

        $r->addRoute('GET', '/cinema', ["App\controllers\admin\CinemaController", "index"]);
        $r->addRoute('GET', '/cinema/create', ["App\controllers\admin\CinemaController", "create"]);
        $r->addRoute('POST', '/cinema/store', ["App\controllers\admin\CinemaController", "store"]);

        $r->addRoute('GET', '/film', ["App\controllers\admin\FilmController", "index"]);
        $r->addRoute('GET', '/film/create', ["App\controllers\admin\FilmController", "create"]);
        $r->addRoute('POST', '/film/store', ["App\controllers\admin\FilmController", "store"]);
    });
    // TODO удалить потом
//    $r->addRoute('POST', '/test', ["App\controllers\HomeController", "test"]);
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
