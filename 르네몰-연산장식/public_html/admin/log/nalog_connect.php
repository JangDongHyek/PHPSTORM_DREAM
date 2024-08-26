<?
$connect_host="localhost";
$connect_id="yensan";
$connect_pass="fpcm080";
$connect_db="yensan";
$admin_id="admin";
$admin_pass="1111";

$connect=@mysql_connect($connect_host,$connect_id,$connect_pass);
$mysql=@mysql_select_db($connect_db,$connect);
?>