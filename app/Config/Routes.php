<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes
$routes->get('/', 'AuthController::login');

// Authentication
$routes->match(['get', 'post'], 'login', 'AuthController::login');
$routes->match(['get', 'post'], 'register', 'AuthController::register');
$routes->get('logout', 'AuthController::logout');

// Unauthorized Route
$routes->get('unauthorized', 'AuthController::unauthorized');

// Common Auth Routes 
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('profile', 'ProfileController::show');
    $routes->get('profile/edit', 'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');
});

// Student Routes
$routes->group('', ['filter' => 'auth:student'], function ($routes) {
    $routes->get('student/dashboard', 'StudentController::dashboard');
});

// Teacher Routes (Teacher & Admin allowed)
$routes->group('', ['filter' => 'auth:teacher,admin'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('students', 'StudentController::index');
    $routes->get('students/create', 'StudentController::create');
    $routes->post('students/store', 'StudentController::store');
    $routes->get('students/show/(:num)', 'StudentController::show/$1');
    $routes->get('students/edit/(:num)', 'StudentController::edit/$1');
    $routes->post('students/update/(:num)', 'StudentController::update/$1');
    $routes->get('students/delete/(:num)', 'StudentController::delete/$1');
});

// Admin Routes
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('roles', 'Admin\RoleController::index');
    $routes->get('roles/create', 'Admin\RoleController::create');
    $routes->post('roles/store', 'Admin\RoleController::store');
    $routes->get('roles/edit/(:num)', 'Admin\RoleController::edit/$1');
    $routes->post('roles/update/(:num)', 'Admin\RoleController::update/$1');
    $routes->get('roles/delete/(:num)', 'Admin\RoleController::delete/$1');
    $routes->get('users', 'Admin\UserAdminController::index');
    $routes->post('users/assign-role/(:num)', 'Admin\UserAdminController::assignRole/$1');
});

// API ROUTES
$routes->group('api/v1', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    // 1. PUBLIC ROUTE (Asking the front desk for a key)
    $routes->post('auth/token', 'AuthController::createToken');
    // 2. PROTECTED ROUTES (Where the bouncer steps in)
    $routes->group('', ['filter' => 'api_auth'], static function ($routes) {
        // Fetch all students
        $routes->get('students', 'StudentController::index');
        // Fetch a single student by ID
        $routes->get('students/(:num)', 'StudentController::show/$1');
    });
});
