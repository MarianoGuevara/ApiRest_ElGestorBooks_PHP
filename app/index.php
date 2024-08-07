<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get("/", function(Request $request, Response $response, $args) {
    // $params = $request->getQueryParams();
    $params = "ajksjaks";
    $response->getBody()->write(json_encode($params));

    return $response;
});


$app->run();
