<?php
include_once("../model/model.php");
$response = array("message" => "");
$_method = $_POST["_method"];

$HostName = "localhost";
$DbName = "khj";
$Admin = "khj";
$AdminPass = "tpsxja!@#";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

$model = new Model(array(
    "db" => "khj",
    "connect" => $dbconn,
    "table" => "example",
    "primary" => "idx",
    "autoincrement" => true
));



?>