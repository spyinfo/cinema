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
//        abort(404);
        echo "<div>Error 404.</div>";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // Ошибка 405. Метод не разрешен
//        abort(405);
        echo "<div>Error 405.</div>";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, $vars);
        break;
}