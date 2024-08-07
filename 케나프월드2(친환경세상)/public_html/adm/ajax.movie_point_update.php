<?php
include_once("./_common.php");
$sql="update g5_movie_point set status='$status' where idx='$idx'";
sql_query($sql);
$result['success'] = true;
echo json_encode($result);

?>