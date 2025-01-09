<?
####################################################################################
//					준비
####################################################################################
if(!@include"nalog_connect.php"){echo"<script lanugage=javascript>alert('Please install first :)')</script>
<meta http-equiv='refresh' content='0;url=install.php'>";exit;}
include "lib.php";
$new_board=$counter;

####################################################################################
//					체크
####################################################################################
nalog_admin_check("$HTTP_REFERER");

####################################################################################
//					접속기록삭제
####################################################################################
if($mode=="del_counter"){
nalog_drop("nalog3_counter_".$counter);
include"nalog_schema.php";
}

####################################################################################
//					로그기록삭제
####################################################################################
if($mode=="del_log"){
nalog_drop("nalog3_log_".$counter);
nalog_drop("nalog3_dlog_".$counter);
include"nalog_schema.php";
}

####################################################################################
//					통계기록삭제
####################################################################################
if($mode=="del_data"){
$query="delete from nalog3_data where counter='$counter'";
$result=@mysql_query($query,$connect);
}

####################################################################################
//					os기록삭제
####################################################################################
if($mode=="del_os"){
$query="delete from nalog3_os where counter='$counter'";
$result=@mysql_query($query,$connect);
}

####################################################################################
//					개별로그삭제1
####################################################################################
if($mode=="del_log_1"){
$query="delete from nalog3_log_$counter where no='$no'";
$result=@mysql_query($query,$connect);
mysql_close($connect);
nalog_go("$HTTP_REFERER");
}

####################################################################################
//					개별로그삭제2
####################################################################################
if($mode=="del_log_2"){
$query="delete from nalog3_dlog_$counter where no='$no'";
$result=@mysql_query($query,$connect);
mysql_close($connect);
nalog_go("$HTTP_REFERER");
}

####################################################################################
//					개별로그삭제3
####################################################################################
if($mode=="del_log_3"){
for($i=0;$i<10;$i++){
if(!$chk[$i]){continue;}
$query="delete from nalog3_log_$counter where no='$chk[$i]'";
$result=@mysql_query($query,$connect);
}
mysql_close($connect);
nalog_go("$HTTP_REFERER");
}

####################################################################################
//					개별로그삭제4
####################################################################################
if($mode=="del_log_4"){
for($i=0;$i<=10;$i++){
if(!$chk[$i]){continue;}
$query="delete from nalog3_dlog_$counter where no='$chk[$i]'";
$result=@mysql_query($query,$connect);
}
mysql_close($connect);
nalog_go("$HTTP_REFERER");
}

####################################################################################
//					이동
####################################################################################
mysql_close($connect);
nalog_go("admin_counter.php?counter=$counter&mode=10");
?>