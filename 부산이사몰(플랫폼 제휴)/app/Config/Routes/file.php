<?php
/**
 * 파일 관련
 * @var RouteCollection $routes
 */

$routes->group('file', [], static function ($routes) { // 'filter' => 'logincheck'
    // 파일업로드 (1개)
    $routes->post('upload', '_common\FileController::uploadSingleFile');

    // 파일다운로드
    $routes->get('download', '_common\FileController::downloadFile');
});