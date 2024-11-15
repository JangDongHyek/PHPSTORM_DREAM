<?
####################################################################################
//					ÄíÅ°±Á±â
####################################################################################
$admin_id = "daylife";
$admin_pass = "click";
$logcounter = "daylife";

if($auto){$auto=time()+30*24*3600;}else{$auto=0;}
setcookie("nalog_admin",md5($admin_id.$admin_pass),$auto,"/");

echo "<meta http-equiv='refresh' content='0; URL=./log/admin_counter.php?counter=$logcounter&mode=1'>";
?>