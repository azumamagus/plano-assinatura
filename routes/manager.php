<?php

$routes->group('manager', ['namespace' => 'App\Controllers\Manager'], static function ($routes) {
    $routes->get('/', 'ManagerController::index', ['as' => 'manager']);

    $routes->group('categories', function ($routes) {
        $routes->get('/', 'CategoriesController::index', ['as' => 'categories']);
        $routes->get('get-all', 'CategoriesController::getAllCategories', ['as' => 'categories.get.all']);
    });
});
