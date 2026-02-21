<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/addNewUser', 'RegisterController::register');


$routes->get('/profile', 'ProfileController::index');
$routes->post('/profile/edit', 'ProfileController::edit');
$routes->delete('/profile/delete', 'ProfileController::delete');

$routes->get('categories',        'CategoryController::index');
$routes->get('categories/(:num)', 'CategoryController::show/$1');
$routes->get('categories/create',  'CategoryController::create');
$routes->post('categories/store',  'CategoryController::store');


$routes->get('photos',           'PhotoController::index');
$routes->get('photos/create',    'PhotoController::create');
$routes->post('photos/store',    'PhotoController::store');
$routes->get('photos/(:num)',    'PhotoController::show/$1');
$routes->get('photos/(:num)/edit',    'PhotoController::edit/$1');
$routes->post('photos/(:num)/update', 'PhotoController::update/$1');
$routes->post('photos/(:num)/delete', 'PhotoController::delete/$1');


$routes->post('photos/(:num)/comments',        'CommentController::store/$1');
$routes->get('photos/(:num)/comments/(:num)/delete', 'CommentController::delete/$2');