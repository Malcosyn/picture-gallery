<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/addNewUser', 'RegisterController::register');

$routes->get('/login', 'LoginController::index');
$routes->post('/login/verify', 'LoginController::login');

$routes->get('/logout', 'ProfileController::logout');

$routes->get('/profile', 'ProfileController::index');
$routes->post('/profile/edit', 'ProfileController::edit');
$routes->delete('/profile/delete', 'ProfileController::delete');

$routes->get('/dashboard', 'DashboardController::index');