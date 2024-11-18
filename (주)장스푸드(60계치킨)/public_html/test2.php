<?php
include_once('./_common.php');

// JSON 데이터를 읽습니다.
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$lat = $data['lat'];
$lng = $data['lng'];

// 데이터베이스에 좌표 데이터를 업데이트합니다.
$sql = "UPDATE g5_write_store SET wr_7 = '$lat', wr_8 = '$lng' WHERE wr_id = '$id'";
sql_query($sql);

echo "Coordinates updated for ID: " . $id;
?>