<?php

function alert($msg,$link){
  echo "<script charset='utf-8'>";
  echo "alert('{$msg}');";
  echo "location.href='{$link}';";
  echo "</script>";
}

function alert_back($msg){
  echo "<script charset='utf-8'>";
  echo "alert('{$msg}');";
  echo "history.go(-1);";
  echo "</script>";
}

function move_page($location){
  echo "<script>";
  echo "location.replace('{$location}');";
  echo "</script>";
}



?>
