<?php

$routes->group('manager', ['namespace' => 'App\Controllers\Manager'], static function ($routes) {
    $routes->get('/', 'ManagerController::index', ['as' => 'manager']);
});
