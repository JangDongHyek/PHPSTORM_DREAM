<?php
include_once('./_common.php');
$sql="insert g5_movie_point set
		mb_id='$member[mb_id]',
		point='$point',
		status='0',
		regdate='".time()."'";
sql_query($sql);
goto_url("./mymovie.php");
?>