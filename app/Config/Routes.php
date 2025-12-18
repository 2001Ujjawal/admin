<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::index');
    $routes->post('admin-login', 'AuthController::authLogin');
    $routes->post('logout', 'AuthController::logout');
});

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->group('dashboard', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'DashboardController::index');
    });
    $routes->group('users', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'UserController::index');
    });
});
