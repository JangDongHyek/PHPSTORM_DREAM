<?
####################################################################################
//					���
####################################################################################
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

####################################################################################
//					�غ�
####################################################################################
if(!@include"nalog_connect.php"){echo"<script lanugage=javascript>alert('Please install first :)')</script>
<meta http-equiv='refresh' content='0;url=install.php'>";exit;}
include "lib.php";
@include "nalog_language.php";
@include "language/$language/language.php";

####################################################################################
//					����üũ
####################################################################################
if($id!=$admin_id){nalog_error($lang[login_error_id_wrong]);}
if($pass!=$admin_pass){nalog_error($lang[login_error_pass_wrong]);}

####################################################################################
//					��Ű����
####################################################################################
if($auto){$auto=time()+30*24*3600;}else{$auto=0;}
setcookie("nalog_admin",md5($admin_id.$admin_pass),$auto,"/");

####################################################################################
//					�̵�
####################################################################################
mysql_close($connect);
if($go){nalog_go("$go");exit;}
if($history){nalog_go("$history");exit;}
nalog_go("root.php");
?>