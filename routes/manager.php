<?php

$routes->group('manager', ['namespace' => 'App\Controllers\Manager'], static function ($routes) {
    $routes->get('/', 'ManagerController::index', ['as' => 'manager']);

    $routes->group('categories', function ($routes) {
        $routes->get('/', 'CategoriesController::index', ['as' => 'categories']);
        $routes->get('get-all', 'CategoriesController::getAllCategories', ['as' => 'categories.get.all']);
        $routes->get('get-info', 'CategoriesController::getAllCategoryInfo', ['as' => 'categories.get.info']);
        $routes->get('get-parents', 'CategoriesController::getDropdownParents', ['as' => 'categories.get.parents']);

        $routes->post('create', 'CategoriesController::create', ['as' => 'categories.create']);
        $routes->put('update', 'CategoriesController::update', ['as' => 'categories.update']);
    });
});
