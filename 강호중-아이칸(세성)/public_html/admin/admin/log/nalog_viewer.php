<?
####################################################################################
//					�غ�
####################################################################################
if(eregi(":\/\/",$path)){echo "error : Unknown path name";exit;}

if(!$path){$path=".";}
else{$path=@eregi_replace("^/|/$","",$path);}
if($id && !$counter){$counter=$id;}

@include "$path/nalog_connect.php";
@include "$path/lib.php";
@include "$path/nalog_info.php";
$version=$nalog_info[version];

####################################################################################
//					�⺻����
####################################################################################
$set=@nalog_config("$counter");
if(!$set){echo "error : Unknown counter name";exit;}
$total=$set[total];

####################################################################################
//					�ð�����
####################################################################################
if($set[time_zone2]){
	if($set[time_zone1]){$time_zone=$set[time_zone2]*3600;}
	else{$time_zone=$set[time_zone2]*3600*(-1);}
}else{
$time_zone=0;
}

$time=time()+$time_zone;
$yy=date('Y',$time);
$mm=date('m',$time);$mm=ereg_replace("^0","",$mm);
$dd=date('d',$time);$dd=ereg_replace("^0","",$dd);
$hh=date('H',$time);$hh=ereg_replace("^0","",$hh);
$week=date('w',$time);

####################################################################################
//					�����ڼ���
####################################################################################
global $HTTP_COOKIE_VARS;
$member_id=$set[member_id];
$member_id=$HTTP_COOKIE_VARS[$member_id];
$ip=$REMOTE_ADDR;

#######################################################################################################
//					����������
#######################################################################################################
if($set[now_check]){
####################################################################################
//					����
####################################################################################
$temp=$time-$set[connecting];
$input="delete from nalog3_now_$counter where time<$temp";
@mysql_query($input,$connect);

####################################################################################
//					�ֱ�
####################################################################################
$query="insert into nalog3_now_$counter (ip,id,time) values ('$ip','$member_id','$time')";
@mysql_query($query,$connect);

####################################################################################
//					�����ڱ��ϱ�
####################################################################################
$query="select count(*) from nalog3_now_$counter";
$connector=@mysql_fetch_array(@mysql_query($query,$connect));
$now=$connector["count(*)"];

####################################################################################
//					�ְ�������
####################################################################################
if($set[peak]<$now){
$set[peak]=$now;
}
}
#######################################################################################################
//					���������ڳ�
#######################################################################################################

####################################################################################
//					��ü�湮�ڳֱ�
####################################################################################
$input="update nalog3_config_$counter set peak='$set[peak]',total='$total' where no=1";
@mysql_query($input,$connect);

####################################################################################
//					���ù湮��
####################################################################################
$query="select * from nalog3_data where yy='$yy' and mm='$mm' and dd='$dd' and counter='$counter'";
$today=@mysql_fetch_array(@mysql_query($query,$connect));
$today=$today[hit];

####################################################################################
//					�ִ�湮������
####################################################################################
$query="select max(hit) from nalog3_data where counter='$counter'";
$day_peak=@mysql_fetch_array(@mysql_query($query,$connect));
$day_peak=$day_peak[0];

####################################################################################
//					�����湮��
####################################################################################
$time=$time-(24*3600);
$yy=date('Y',$time);
$mm=date('m',$time);
$dd=date('d',$time);
$query="select * from nalog3_data where yy='$yy' and mm='$mm' and dd='$dd' and counter='$counter'";
$yester=@mysql_fetch_array(@mysql_query($query,$connect));
$yester=$yester[hit];
if(!$yester){$yester=0;}

####################################################################################
//					��Ų����
####################################################################################
if(!$today){$today=0;}
if(!$yester){$yester=0;}
if(!$total){$total=0;}
if(!$now){$now=0;}
if(!$peak){$peak=0;}
if(!$day_peak){$day_peak=0;}

$peak=$set[peak];
$today_image=$today_text=$today;
$yester_image=$yester_text=$yester;
$total_image=$total_text=$total;
$now_image=$now_text=$now;
$peak_image=$peak_text=$peak;
$day_peak_image=$day_peak_text=$day_peak;

for($i=0;$i<=9;$i++){$today_image=str_replace("$i","<img src=�ڡڡ�/${i}.gif border=0 align=absmiddle �١١�>",$today_image);}
for($i=0;$i<=9;$i++){$yester_image=str_replace("$i","<img src=�ڡڡ�/${i}.gif border=0 align=absmiddle �١١�>",$yester_image);}
for($i=0;$i<=9;$i++){$total_image=str_replace("$i","<img src=�ڡڡ�/${i}.gif border=0 align=absmiddle �١١�>",$total_image);}
for($i=0;$i<=9;$i++){$now_image=str_replace("$i","<img src=�ڡڡ�/${i}.gif border=0 align=absmiddle �١١�>",$now_image);}
for($i=0;$i<=9;$i++){$peak_image=str_replace("$i","<img src=�ڡڡ�/${i}.gif border=0 align=absmiddle �١١�>",$peak_image);}
for($i=0;$i<=9;$i++){$day_peak_image=str_replace("$i","<img src=�ڡڡ�/${i}.gif border=0 align=absmiddle �١١�>",$day_peak_image);}

$today_image=@str_replace("�ڡڡ�",$path."/skin/$set[skin]",$today_image);
$yester_image=@str_replace("�ڡڡ�",$path."/skin/$set[skin]",$yester_image);
$total_image=@str_replace("�ڡڡ�",$path."/skin/$set[skin]",$total_image);
$now_image=@str_replace("�ڡڡ�",$path."/skin/$set[skin]",$now_image);
$peak_image=@str_replace("�ڡڡ�",$path."/skin/$set[skin]",$peak_image);
$day_peak_image=@str_replace("�ڡڡ�",$path."/skin/$set[skin]",$day_peak_image);

$alt="alt='analyzer $version' onclick=window.open(\"$path/admin_counter.php?counter=$counter\") style=cursor:hand";
$today_image=@str_replace("�١١�",$alt,$today_image);
$yester_image=@str_replace("�١١�",$alt,$yester_image);
$total_image=@str_replace("�١١�",$alt,$total_image);
$now_image=@str_replace("�١١�",$alt,$now_image);
$peak_image=@str_replace("�١١�",$alt,$peak_image);
$day_peak_image=@str_replace("�١١�",$alt,$day_peak_image);

####################################################################################
//					��Ų��������
####################################################################################
if($set[skin_check]){
$skin="$path/skin/$set[skin]";
include"$skin/skin.php";
}

@mysql_close($connect);
?>