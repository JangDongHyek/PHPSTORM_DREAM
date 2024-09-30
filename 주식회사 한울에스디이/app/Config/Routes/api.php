<?php
/** @var $routes */

$routes->group('api', static function ($routes) {
    // 메인
    $routes->get('test', 'app\UserController::test');
    $routes->post('user', 'app\UserController::method');
    $routes->post('board', 'app\BoardController::method');

});