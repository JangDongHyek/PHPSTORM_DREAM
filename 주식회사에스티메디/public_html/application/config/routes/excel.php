<?php
/**
 * 파일다운로드, 파일업로드 라우터
 */
$route['excel/download'] = 'CommonExcelController/downloadExcel';
$route['excel/downloadAgency'] = 'CommonExcelController/downloadAgencyExcel';
$route['excel/upload']['post'] = 'CommonExcelController/uploadExcel';
