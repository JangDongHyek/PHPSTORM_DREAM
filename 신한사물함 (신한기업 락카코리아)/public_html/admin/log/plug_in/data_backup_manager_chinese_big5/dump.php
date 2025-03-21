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
//			變數設定
####################################################################################
$time=date('Y.m.d.H.i.s');
$filename="nalog5_backup_$time.sql";

for($i=0;$i<10;$i++)
{
if(!trim($name[$i])){continue;}
$counter_id[]=$name[$i];
}

if(!sizeof($counter_id)){nalog_error('請最少選擇一個計數器以作備份');}

####################################################################################
//			備份資料檔案的頁首部份
####################################################################################
$header="####################################################################################
#
#				navyism@log analyzer 5
#				 Data Backup Manager
#
####################################################################################

# n@log version   : $nalog_info[version] ($nalog_info[date])
# Generation time : ".date('Y.m.d H:i:s')."
# Host URL        : ".eregi_replace("\/admin_counter.php(.)+$","",$HTTP_REFERER)."
# Counter ID      : ".implode(",",$counter_id)."

# End of header


";

####################################################################################
//			下載備份資料檔案到自己電腦
####################################################################################
if($how==1)
{
	if(eregi("(MSIE 5.5|MSIE 6.0)", $HTTP_SERVER_VARS[HTTP_USER_AGENT]))
	{
	Header("Content-type: application/octet-stream");
	Header("Content-Disposition: attachment; filename=$filename");
	Header("Content-Transfer-Encoding: binary");
	Header("Pragma: no-cache");
	Header("Expires: 0");
	}
	else
	{
	Header("Content-type: file/unknown");
	Header("Content-type: application/octet-stream");
	Header("Content-Disposition: attachment; filename=$filename");
	Header("Content-Description: PHP3 Generated Data");
	Header("Pragma: no-cache");
	Header("Expires: 0");
	}

	echo $header;

	for($i=0;$i<10;$i++)
	{
	if(!trim($name[$i])){continue;}

	nalog_dump("nalog3_data"," where counter='$name[$i]'",0,"$name[$i]",1);
	nalog_dump("nalog3_os"," where counter='$name[$i]'",0,"$name[$i]",1);
	nalog_table("nalog3_counter_$name[$i]","$name[$i]",1);
	nalog_dump("nalog3_counter_$name[$i]","",0,"$name[$i]",1);
	nalog_table("nalog3_log_$name[$i]","$name[$i]",1);
	nalog_dump("nalog3_log_$name[$i]","",0,"$name[$i]",1);
	nalog_table("nalog3_dlog_$name[$i]","$name[$i]",1);
	nalog_dump("nalog3_dlog_$name[$i]","",0,"$name[$i]",1);
	nalog_table("nalog3_config_$name[$i]","$name[$i]",1);
	nalog_dump("nalog3_config_$name[$i]","",100,"$name[$i]",1);
	}

####################################################################################
//			將備份資料檔案儲存到伺服器
####################################################################################
}else{
$fp=fopen("../../$filename",w);
if(!$fp){nalog_error("請把 n@log 主資料夾的權限值設為 707 或 777，\\n否則任何資料也無法被寫進去的。");}
fwrite($fp,$header);

	for($i=0;$i<10;$i++)
	{
	if(!trim($name[$i])){continue;}

	$result=nalog_dump("nalog3_data"," where counter='$name[$i]'",0,"$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_dump("nalog3_os"," where counter='$name[$i]'",0,"$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_table("nalog3_counter_$name[$i]","$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_dump("nalog3_counter_$name[$i]","",0,"$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_table("nalog3_log_$name[$i]","$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_dump("nalog3_log_$name[$i]","",0,"$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_table("nalog3_dlog_$name[$i]","$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_dump("nalog3_dlog_$name[$i]","",0,"$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_table("nalog3_config_$name[$i]","$name[$i]",0);
	fwrite($fp,$result);
	$result=nalog_dump("nalog3_config_$name[$i]","",100,"$name[$i]",0);
	fwrite($fp,$result);
	}
fclose($fp);
chmod("../../$filename",0777);
nalog_msg("一個檔名為 ".$filename." 的備份資料檔案\\n已經成功地儲存到您的 n@log 主資料夾了！");
nalog_go($HTTP_REFERER);
}

####################################################################################
//			本插件所需的程式庫
####################################################################################
function nalog_table($table_name,$title,$how)
{
global $connect,$nalog_info;
$data=mysql_fetch_array(mysql_query("show create table `$table_name`"));
$result_temp= "


# $title in n@log $nalog_info[version]
# create table $table_name

$data[1];
";
if($how){echo $result_temp;}
else{return $result_temp;}
}

function nalog_dump($table_name,$where,$set_null,$title,$how)
{
global $connect,$nalog_info;
$result=mysql_query("select * from $table_name $where");
$eof=@mysql_num_fields($result);
$count=(int)@mysql_num_rows($result);

$result_temp.="


# $title in n@log $nalog_info[version]
# $table_name $count rows

";
while($data=@mysql_fetch_array($result)){
flush();
unset($temp);

	for($i=0;$i<$eof;$i++){
	$data[$i]=str_replace("\\","",$data[$i]);
	if($set_null==$i){$temp[]="''";}
	else{$temp[]="'$data[$i]'";}
	}
$result_temp.= "INSERT INTO `$table_name` VALUES (".implode(",",$temp).");\r\n";
}

if($how){echo $result_temp;}
else{return $result_temp;}
}
?>