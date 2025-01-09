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
//			Checking the backup file to be uploaded
####################################################################################
$backup=$HTTP_POST_FILES["backup"]["tmp_name"];
$backup_name=$HTTP_POST_FILES["backup"]["name"];
if(!eregi("\.sql$",$backup_name)){nalog_error("It is not an .sql file.");}

####################################################################################
//			Uploading the backup file
####################################################################################
@move_uploaded_file($backup,"../../".$backup_name) or nalog_error("Permission Denied - data cannot be written on n@log root folder.");

####################################################################################
//			End of file upload process
####################################################################################
nalog_msg("The upload of a backup file was successful!");
nalog_go($HTTP_REFERER);
?>