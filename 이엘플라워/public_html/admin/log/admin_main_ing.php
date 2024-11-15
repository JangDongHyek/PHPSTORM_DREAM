<?
####################################################################################
//					준비
####################################################################################
if(!@include"nalog_connect.php"){echo"<script lanugage=javascript>alert('Please install first :)')</script>
<meta http-equiv='refresh' content='0;url=install.php'>";exit;}
include "lib.php";
if(!@include "nalog_language.php"){nalog_go("install.php");}
if(!@include"language/$language/language.php"){nalog_go("install.php");}

####################################################################################
//					체크
####################################################################################
//nalog_admin_check("$PHP_SEFP");
$set=nalog_config("$counter");
if(!$set){nalog_error($lang[counter_manager_error_not_exist]);}
nalog_chk_num($total,0,"$lang[counter_manager_error_total_is]","");
nalog_chk_num($cookie_time,0,"$lang[counter_manager_error_cookie_time]","");
nalog_chk_num($connecting,0,"$lang[counter_manager_error_connect_time]","");
nalog_chk_num($log_limit,0,"$lang[counter_manager_error_log_limit]","");

####################################################################################
//					저장
####################################################################################
$value="
skin='$skin',
cookie='$cookie',
cookie_time='$cookie_time',
counter_check='$counter_check',
now_check='$now_check',
log_check='$log_check',
skin_check='$skin_check',
connecting='$connecting',
counter_limit='$counter_limit',
log_limit='$log_limit',
member_id='$member_id',
auth_time='$auth_time',
auth_day='$auth_day',
auth_week='$auth_week',
auth_month='$auth_month',
auth_year='$auth_year',
auth_log='$auth_log',
auth_dlog='$auth_dlog',
auth_os='$auth_os',
auth_member='$auth_member',
auth_ip='$auth_ip',
total='$total',
check_admin='$check_admin',
time_zone1='$time_zone1',
time_zone2='$time_zone2'
";
$query="update nalog3_config_$counter set $value where no=1";
$is_ok=mysql_query($query,$connect);
if(!$is_ok){nalog_msg("upgrade to 5.0.2");nalog_go("upgrader.php");}

####################################################################################
//					이동
####################################################################################
mysql_close($connect);
nalog_go("admin_counter.php?counter=$counter&mode=$mode");
?>