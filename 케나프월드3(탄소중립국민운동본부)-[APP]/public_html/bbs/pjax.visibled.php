<?php
include_once('./_common.php');
$pjax = get_session("pjax");
if($pjax)
	set_session("pjax", "");
else
	set_session("pjax", "true");

?>