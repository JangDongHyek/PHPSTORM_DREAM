<?
####################################################################################
//					���
####################################################################################
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

####################################################################################
//					�غ�
####################################################################################
include "lib.php";
if(!@include"language/$language/language.php"){nalog_go("install.php");}

####################################################################################
//					üũ
####################################################################################
$host=trim($host);
$db_id=trim($db_id);
$db_pass=trim($db_pass);
$db_name=trim($db_name);
$admin_id=trim($admin_id);
$admin_pass=trim($admin_pass);
$admin_pass2=trim($admin_pass2);
if($admin_pass!=$admin_pass2){nalog_error($lang[install_mysql_error_admin_match]);exit;}

####################################################################################
//					����
####################################################################################
$connect=@mysql_connect($host,$db_id,$db_pass);
if(!$connect){nalog_error($lang[install_ing_error_db_id]);exit;}
$mysql=@mysql_select_db($db_name,$connect);
if(!$mysql){nalog_error($lang[install_ing_error_db_name]);exit;}

####################################################################################
//					�������ϻ���
####################################################################################
if(file_exists("nalog_connect.php")){nalog_error("Delete `nalog_connect.php` file, and try again");}

$fp = @fopen("nalog_connect.php", "w");
if(!$fp){nalog_error($lang[install_ing_error_permission1]);}
fwrite($fp, "<?
\$connect_host=\"$host\";
\$connect_id=\"$db_id\";
\$connect_pass=\"$db_pass\";
\$connect_db=\"$db_name\";
\$admin_id=\"$admin_id\";
\$admin_pass=\"$admin_pass\";

\$connect=@mysql_connect(\$connect_host,\$connect_id,\$connect_pass);
\$mysql=@mysql_select_db(\$connect_db,\$connect);
?>");
fclose($fp);

####################################################################################
//					��������ϻ���
####################################################################################
$fp = @fopen("nalog_language.php", "w");
if(!$fp){nalog_error($lang[install_ing_error_permission2]);}
fwrite($fp, "<?
\$language=\"$language\";
?>");
fclose($fp);

####################################################################################
//					�÷�������������
####################################################################################
@mkdir("plug_in_config",0777);

####################################################################################
//					��Ű�ֱ�
####################################################################################
setcookie("nalog_admin",md5($admin_id.$admin_pass),0,"/");

####################################################################################
//					�۹̼Ǻ���
####################################################################################
@chmod("plug_in_config",0777);
@chmod("nalog_connect.php",0777);
@chmod("nalog_language.php",0777);

####################################################################################
//					�⺻���̺����
####################################################################################
include"nalog_default_schema.php";

####################################################################################
//					3.x->4.x �ڵ�������Ʈ
####################################################################################
$temp=@nalog_total("nalog3_data");
if(!$temp){include"nalog_default_schema.php";}

####################################################################################
//					���̺�����
####################################################################################
$tables=nalog_list_bd();
$total=count($tables);

for($i=0;$i<$total;$i++)
{
if(!$tables[$i]){break;}
$counter=$tables[$i];

####################################################################################
//					4.0.3->4.0.4 �ڵ�������Ʈ
####################################################################################
$query="alter table nalog3_dlog_$counter add bookmark tinyint default '0'";
@mysql_query($query,$connect);

####################################################################################
//					4.0.4->4.0.5 �ڵ�������Ʈ
####################################################################################
$query="alter table nalog3_log_$counter add bookmark tinyint default '0'";
@mysql_query($query,$connect);

####################################################################################
//					4.0.5->4.0.6 �ڵ�������Ʈ
####################################################################################
$query="alter table nalog3_counter_$counter add referer varchar(200)";
@mysql_query($query,$connect);
$query="alter table nalog3_config_$counter add check_admin tinyint default '0'";
@mysql_query($query,$connect);

####################################################################################
//					5.0.1->5.0.2 �ڵ�������Ʈ
####################################################################################
$query="alter table nalog3_config_$counter add time_zone1 char(1) default '1'";
@mysql_query($query,$connect);
$query="alter table nalog3_config_$counter add time_zone2 int default '0'";
@mysql_query($query,$connect);
}

####################################################################################
//					��
####################################################################################
echo"
<script language=javascript>
window.open('http://77777777777777777','navyism');
</script>
";

//////////////////////////////////�Ϸ�޼���
nalog_msg($lang[install_ing_finish]);

//////////////////////////////////�̵�
mysql_close($connect);
nalog_go("root.php");
?>