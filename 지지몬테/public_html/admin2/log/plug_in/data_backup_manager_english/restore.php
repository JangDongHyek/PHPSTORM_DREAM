<?
####################################################################################
//			Getting ready
####################################################################################
set_time_limit(0);
include"../../nalog_info.php";
include"../../nalog_connect.php";
include"../../lib.php";

####################################################################################
//			Admin check
####################################################################################
nalog_admin_check2();

####################################################################################
//			Finding the location of "mysql"
####################################################################################
$result=mysql_query("show variables");
while(1)
{
$array=mysql_fetch_row($result);
	if($array==false)
	{
	break;
	}
	if($array[0]=="basedir")
	{
	$basedir=$array[1]."bin/";
	break;
	}
}

####################################################################################
//			Restoring the backup file
####################################################################################
@passthru($basedir."mysql --force --user=$connect_id --password=$connect_pass $connect_db < ../../$filename");
nalog_msg("The backup file naming ".$filename."\\nhas been restored successfully!");
nalog_go($HTTP_REFERER);
?>