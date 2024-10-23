<?php
/**
 * 파일다운로드, 파일업로드 라우터
 */
$route['file/download'] = 'CommonFileController/downloadFile';
$route['file/upload']['post'] = 'CommonFileController/uploadSingleFile';
