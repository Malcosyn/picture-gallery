<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/addNewUser', 'RegisterController::register');


$routes->get('/profile', 'ProfileController::index');
