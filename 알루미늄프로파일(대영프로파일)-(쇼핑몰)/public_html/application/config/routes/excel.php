<?php
/**
 * 파일다운로드, 파일업로드 라우터
 */
$route['excel/download']['get'] = 'CommonExcelController/downloadExcel';
$route['excel/upload']['post'] = 'CommonExcelController/uploadExcel';
