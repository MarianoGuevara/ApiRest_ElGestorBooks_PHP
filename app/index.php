<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';
require_once './bbdd/AccesoDatos.php';
require_once './controladores/test.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// instanciar app
$app = AppFactory::create();
$app->addBodyParsingMiddleware();



$app->group('/test', function (RouteCollectorProxy $group) {
    $group->get('[/]', \TestController::class . ':test1');

});

$app->run();
