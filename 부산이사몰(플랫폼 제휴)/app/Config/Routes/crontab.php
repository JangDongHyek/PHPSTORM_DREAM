<?php
/**
 * crontab
 * @var RouteCollection $routes
 */

$routes->group('crontab', function ($routes) {
    $routes->get('callStatCrontab', '_common\CrontabController::callStatCrontab');
});