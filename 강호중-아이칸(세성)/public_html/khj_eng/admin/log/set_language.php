<?
if(!@include"nalog_connect.php"){echo"<script lanugage=javascript>alert('Please install first :)')</script>
<meta http-equiv='refresh' content='0;url=install.php'>";exit;}
include "lib.php";
if(!@include"language/$language/language.php"){nalog_go("install.php");}

####################################################################################
//					체크
####################################################################################
nalog_admin_check("login.php?go=root.php");

$fp = @fopen("nalog_language.php", "w");
if(!$fp){nalog_error($lang[install_ing_error_permission2]);}
fwrite($fp, "<?
\$language=\"$language\";
?>");
fclose($fp);
@mysql_close($connect);
nalog_go($HTTP_REFERER);
?>