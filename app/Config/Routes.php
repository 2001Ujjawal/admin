<?php

use CodeIgniter\Controller;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->options('(:any)', function ($any) {
    $response = service('response');
    $response->setHeader('Access-Control-Allow-Origin', '*');
    $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
    $response->setHeader('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
    return $response->setStatusCode(200);
});
/**
 * admin routes
 */


$routes->get('/', 'Home::index');
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->group('dashboard', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'DashboardController::index');
    });
    $routes->group('libraries', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'LibraryController::index');
    });
});



/**
 * Libraries admin routes
 */

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::index');
    $routes->post('admin-login', 'AuthController::authLogin');
    $routes->post('logout', 'AuthController::logout');

    $routes->get('libraries/login', 'Library\LibraryController::loginPageView');
    $routes->get('libraries/forgot-password', 'Library\LibraryController::forgotPasswordView');

    $routes->group('libraries', ['namespace' => 'App\Controllers\Library', 'filter' => 'libraryWebTokenCheckFilter'], function ($routes) {
        $routes->get('books', 'BooksController::index');
        $routes->get('dashboard', 'DashboardController::index');
    });
});




/**
 * @Api's routes here
 */
$routes->group('', function ($routes) {
    $routes->group('backend-api', ['namespace' => 'App\Controllers\Apis'], function ($routes) {
        $routes->post('libraries/login', 'LibraryLoginApiController::login');
        $routes->post('libraries/otp-send', 'LibraryLoginApiController::sendOtp');
        $routes->post('libraries/', 'LibraryApiController::addLibrary');

        $routes->group('libraries', ['namespace' => 'App\Controllers\Apis', 'filter' => 'apiTokenCheck'], function ($routes) {
            $routes->post('logout', 'LibraryApiController::logout');
            $routes->get('login/sessions', 'LibraryApiController::loginSessionList');
        });
    });
});


// cli command routes 


$routes->resource('test', ['controller' => 'Apis\ResourceController']);

$routes->get('interface-practice', 'Home::interfaceAndImplements');
