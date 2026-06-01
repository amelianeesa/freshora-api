<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes) {
    $routes->resource('orders', ['controller' => 'Orders']);
    $routes->resource('settings', ['controller' => 'Settings']);
    $routes->resource('messages', ['controller' => 'Messages']);
    //unutk users
    $routes->get('users', 'Users::index');
    $routes->post('users/register', 'Users::register');
    $routes->post('users/login', 'Users::Login');
});