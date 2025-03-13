<?php
/** @var $routes */

$routes->group('api', static function ($routes) {
    // 메인
    $routes->get('test', 'api\UserController::test');
    $routes->post('user', 'api\UserController::method');
    $routes->post('board', 'api\BoardController::method');
    $routes->post('board_reply', 'api\BoardReplyController::method');
    $routes->post('project_base', 'api\ProjectBaseController::method');
    $routes->post('project_schedule', 'api\ProjectScheduleController::method');
    $routes->post('project_price', 'api\ProjectPriceController::method');
    $routes->post('jl', 'api\JlController::method');

});

$routes->post('jl/JlApi', 'api\JlController::method');
$routes->post('jl/JlApi.php', 'api\JlController::method');
