<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::index');
    $routes->post('cookie', 'AuthController::cookie');
});

$routes->group('users', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'UserController::index');
});
