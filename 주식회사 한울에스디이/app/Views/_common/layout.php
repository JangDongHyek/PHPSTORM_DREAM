<?php
// 공통 레이아웃
// 헤더
if ($isAdmPage) include_once APPPATH."Views/_common/adm_header.php";
else include_once APPPATH."Views/_common/header.php";

echo $content; // view

// 푸터
if ($isAdmPage) include_once APPPATH."Views/_common/adm_footer.php";
else include_once APPPATH."Views/_common/footer.php";
?>