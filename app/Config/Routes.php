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

$routes->group('', ['filter' => 'auth'], function ($routes) {

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
    $routes->get('/dashboard', 'DashboardController::index');

    $routes->get('/albums', 'AlbumController::showAllAlbum');
    $routes->get('/albums/search', 'AlbumController::searchAlbum');
    $routes->get('/albums/(:num)', 'AlbumController::showAlbum/$1');
    $routes->post('/albums/create', 'AlbumController::createAlbum');
    $routes->post('/albums/delete', 'AlbumController::deleteAlbum');
    $routes->post('/albums/update', 'AlbumController::updateAlbum');
    $routes->get('photos/(:num)/reports/create', 'ReportController::create/$1');
    $routes->post('photos/(:num)/reports',        'ReportController::store/$1');

    $routes->get('/admin', 'AdminController::index');
    $routes->get('/admin/search', 'AdminController::search');
    $routes->get('/admin/users/(:num)', 'AdminController::userDetail/$1');
    $routes->post('/admin/users/(:num)/delete', 'AdminController::deleteUser/$1');
    $routes->post('/admin/users/(:num)/update', 'AdminController::updateUser/$1');
});
