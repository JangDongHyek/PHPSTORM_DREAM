<?
####################################################################################
//					準備
####################################################################################
set_time_limit(0);
include"../../nalog_info.php";
include"../../nalog_connect.php";
include"../../lib.php";

####################################################################################
//					チェック
####################################################################################
nalog_admin_check2();

####################################################################################
//					指定
####################################################################################
$time=date('Y.m.d.H.i.s');
$filename="nalog5_backup_$time.sql";

for($i=0;$i<10;$i++)
{
if(!trim($name[$i])){continue;}
$counter_id[]=$name[$i];
}

if(!sizeof($counter_id)){nalog_error('バックアップを行うカウンタを選択して下さい');}

####################################################################################
//					バックアップヘッダー
####################################################################################
$header="####################################################################################
#
#				navyism@log analyzer 5
#				 Data backup manager
#
####################################################################################

# n@log Version : $nalog_info[version] ($nalog_info[date])
# Generation Time : ".date('Y.m.d H:i:s')."
# Host URL : ".eregi_replace("\/admin_counter.php(.)+$","",$HTTP_REFERER)."
# Counter ID : ".implode(",",$counter_id)."

# End of header 


";

####################################################################################
//					ダウンロード
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
//					ファイル保存
####################################################################################
}else{
$fp=fopen("../../$filename",w);
if(!$fp){nalog_error("n@log フォルダーのパーミションに制限があります\\nパーミションを707に変更して下さい");}
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
nalog_msg("n@logが設置されたフォルダーに ".$filename."ファイルが保存されました");
nalog_go($HTTP_REFERER);
}

####################################################################################
//					Library
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