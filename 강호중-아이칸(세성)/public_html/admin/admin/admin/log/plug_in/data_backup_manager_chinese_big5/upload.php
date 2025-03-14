<?
####################################################################################
//			準備就緒
####################################################################################
set_time_limit(0);
include"../../nalog_info.php";
include"../../nalog_connect.php";
include"../../lib.php";

####################################################################################
//			管理者身份檢查
####################################################################################
nalog_admin_check2();

####################################################################################
//			檢查已上傳的檔案格式
####################################################################################
$backup=$HTTP_POST_FILES["backup"]["tmp_name"];
$backup_name=$HTTP_POST_FILES["backup"]["name"];
if(!eregi("\.sql$",$backup_name)){nalog_error("您剛才所上傳的並不是一個 .sql 檔案");}

####################################################################################
//			上傳備份資料檔案
####################################################################################
@move_uploaded_file($backup,"../../".$backup_name) or nalog_error("資料夾權限不足！資料無法被寫入 n@log 主資料夾。");

####################################################################################
//			上傳動作完成
####################################################################################
nalog_msg("備份資料檔案上傳成功！");
nalog_go($HTTP_REFERER);
?>