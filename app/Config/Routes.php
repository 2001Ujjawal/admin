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

    $routes->group('libraries', ['namespace' => 'App\Controllers\Library'], function ($routes) {
        $routes->get('login', 'LibraryController::loginPageView');
        $routes->get('books', 'BooksController::index');
        $routes->get('dashboard', 'DashboardController::index');
    });
});

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->group('dashboard', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'DashboardController::index');
    });
    $routes->group('libraries', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'LibraryController::index');
    });
});

$routes->group('', function ($routes) {
    $routes->group('backend-api', ['namespace' => 'App\Controllers\Apis'], function ($routes) {
        $routes->group('users', [], function ($routes) {
            $routes->get('(:any)', 'UserApiController::userList/$1');
        });
        $routes->group('libraries', ['namespace' => 'App\Controllers\Apis'], function ($routes) {
            $routes->post('login', 'LibraryApiController::login');
            $routes->post('logout', 'LibraryApiController::logout');
            $routes->post('/', 'LibraryApiController::addLibrary');
        });
    });
});
