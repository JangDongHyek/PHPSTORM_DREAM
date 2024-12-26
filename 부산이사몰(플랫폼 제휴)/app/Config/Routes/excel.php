<?php
/**
 * 엑셀업로드, 다운로드
 * @var RouteCollection $routes
 */
$routes->group('excel', function ($routes) {
    // 엑셀업로드
    $routes->post('upload', '_common\ExcelController::uploadExcel');
    // 업로드된 엑셀파일 읽기
    $routes->get('read/(:any)', '_common\ExcelController::readExcel/$1');
});



