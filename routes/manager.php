<?php

$routes->group('{locale}/manager', ['namespace' => 'App\Controllers\Manager'], static function ($routes) {
    $routes->get('/', 'ManagerController::index', ['as' => 'manager']);

    $routes->group('categories', function ($routes) {
        $routes->get('/', 'CategoriesController::index', ['as' => 'categories']);
        $routes->get('teste', 'CategoriesController::teste', ['as' => 'teste']);
        $routes->get('archived', 'CategoriesController::archived', ['as' => 'categories.archived']);
        $routes->get('get-all', 'CategoriesController::getAllCategories', ['as' => 'categories.get.all']);
        $routes->get('get-all-archived', 'CategoriesController::getAllArchivedCategories', ['as' => 'categories.get.all.archived']);
        $routes->get('get-info', 'CategoriesController::getAllCategoryInfo', ['as' => 'categories.get.info']);
        $routes->get('get-parents', 'CategoriesController::getDropdownParents', ['as' => 'categories.get.parents']);

        $routes->post('create', 'CategoriesController::create', ['as' => 'categories.create']);
        $routes->put('update', 'CategoriesController::update', ['as' => 'categories.update']);
        $routes->put('archive', 'CategoriesController::archive', ['as' => 'categories.archive']);
        $routes->put('recover', 'CategoriesController::recover', ['as' => 'categories.recover']);
        $routes->delete('delete', 'CategoriesController::delete', ['as' => 'categories.delete']);
    });
});
