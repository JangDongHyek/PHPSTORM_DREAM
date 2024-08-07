<?php
include_once("./_common.php");

$sca = $_GET['sca'];

//view에서 sca 세션 저장
set_session("ss_sca", $sca);
?>