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
    $routes->group('students', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'StudentsController::index');
    });
    $routes->group('books', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'BooksController::index');
    });
});

$routes->group('', function ($routes) {
    $routes->group('backend-api', ['namespace' => 'App\Controllers\Apis'], function ($routes) {
        $routes->group('users', [], function ($routes) {
            $routes->get('(:any)', 'UserApiController::userList/$1');
        });
    });
});
