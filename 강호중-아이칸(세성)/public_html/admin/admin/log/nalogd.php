<?
####################################################################################
//					���
####################################################################################
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

####################################################################################
//					�غ�
####################################################################################
@include "nalog_connect.php";
@include "lib.php";

####################################################################################
//					REFERER����
####################################################################################
$get_vars_array=array_keys($HTTP_GET_VARS);
$get_vars_string[]="";
for($i=0;$i<sizeof($get_vars_array);$i++){
$key=$get_vars_array[$i];
if($key=="url" || $key=="counter"){continue;}
$get_vars_string[]="$key=$HTTP_GET_VARS[$key]";
}
$added_value=implode("&",$get_vars_string);
$HTTP_REFERER=$url.$added_value;

####################################################################################
//					�⺻����
####################################################################################
$set=@nalog_config("$counter");
if(!$set){header("location:nalog_image/error.gif");exit;}
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

####################################################################################
//					��Ű����
####################################################################################
$cookie_result=@setcookie("nalog_check",0,0,"/");

if(!$set[cookie]){
$counting=1;
@setcookie("nalog$counter",0,0,"/");
}

if($set[cookie]==1){

if(!$HTTP_COOKIE_VARS["nalog".$counter]){
$counting=1;

@setcookie("nalog$counter",time(),0,"/");
}
}

if($set[cookie]==2){
$temp=time()-$HTTP_COOKIE_VARS["nalog".$counter];
if($temp>$set[cookie_time]){
$counting=1;

@setcookie("nalog$counter",time(),time()+$set[cookie_time],"/");
}
}

if($set[cookie]==3){
$temp1=date('Y-m-d',$HTTP_COOKIE_VARS["nalog".$counter]);
$temp2=date('Y-m-d');
if($temp1!=$temp2){
$counting=1;

@setcookie("nalog$counter",time(),time()+30*24*3600,"/");
}
}

if($set[check_admin] && $HTTP_COOKIE_VARS[nalog_admin]){unset($counting);}

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
//					���ϱ�
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

#######################################################################################################
//					ī����
#######################################################################################################
if($counting){
$total++;

###############################################################################################
//					ī���û��
###############################################################################################
if($set[counter_check]){
####################################################################################
//					��μ���
####################################################################################
if($HTTP_REFERER=="<?=$HTTP_SERVER_VARS[HTTP_REFERER]?>"){$HTTP_REFERER="";}
$dlog=$log=trim($HTTP_REFERER);
$log=@str_replace("http://www.","http://",$log);
$log=@str_replace("http://","",$log);
$log=@explode("/",$log);
$log="http://".$log[0];

####################################################################################
//					os, broswer
####################################################################################
check_agent();
$os=@trim("$os_name $os_version");
$browser=@trim("$br_name $br_version");

####################################################################################
//					��ϳֱ�
####################################################################################
$value="'','$ip','$member_id','$time','$yy','$mm','$dd','$hh','$week','$os','$browser','$HTTP_REFERER'";
$query="insert into nalog3_counter_$counter values ($value)";
@mysql_query($query,$connect);

####################################################################################
//					�����
####################################################################################
$query="select * from nalog3_data where counter='$counter' and yy='$yy' and mm='$mm' and dd='$dd'";
$result=@mysql_fetch_array(@mysql_query($query)); 
if($result){
$query="update nalog3_data set h$hh=h$hh+1, hit=h0+h1+h2+h3+h4+h5+h6+h7+h8+h9+h10+h11+h12+h13+h14+h15+h16+h17+h18+h19+h20+h21+h22+h23 where counter='$counter' and yy='$yy' and mm='$mm' and dd='$dd'";
@mysql_query($query,$connect);
}
else{
$query="insert into nalog3_data (yy,mm,dd,h$hh,week,counter,hit) values ('$yy','$mm','$dd','1','$week','$counter','1')";
@mysql_query($query,$connect);
}

####################################################################################
//					os���
####################################################################################
$query="select * from nalog3_os where counter='$counter' and os='1' and name='$os'";
$result=@mysql_fetch_array(@mysql_query($query)); 
if($result){
$query="update nalog3_os set hit=hit+1 where counter='$counter' and os='1' and name='$os'";
@mysql_query($query,$connect);
}
else{
$query="insert into nalog3_os (name,os,hit,counter) values ('$os','1','1','$counter')";
@mysql_query($query,$connect);
}

####################################################################################
//					broswer���
####################################################################################
$query="select * from nalog3_os where counter='$counter' and os='0' and name='$browser'";
$result=@mysql_fetch_array(@mysql_query($query)); 
if($result){
$query="update nalog3_os set hit=hit+1 where counter='$counter' and os='0' and name='$browser'";
@mysql_query($query,$connect);
}
else{
$query="insert into nalog3_os (name,os,hit,counter) values ('$browser','0','1','$counter')";
@mysql_query($query,$connect);
}

}
###############################################################################################
//					ī���û�볡
###############################################################################################

###############################################################################################
//					�α׻��
###############################################################################################
if($set[log_check]){
####################################################################################
//					�α׳ֱ�
####################################################################################
$temp=nalog_total("nalog3_log_".$counter,"and log='$log'");
if(!$temp){
$value="'','$log','1','$time',''";
$query="insert into nalog3_log_$counter values ($value)";
@mysql_query($query,$connect);
}
else{
$input="update nalog3_log_$counter set hit=hit+1, time='$time' where log='$log'";
@mysql_query($input,$connect);
}

####################################################################################
//					�󼼷α׳ֱ�
####################################################################################
$temp=nalog_total("nalog3_dlog_".$counter,"and log='$dlog'");
if(!$temp){
$value="'','$dlog','1','$time',''";
$query="insert into nalog3_dlog_$counter values ($value)";
@mysql_query($query,$connect);
}
else{
$input="update nalog3_dlog_$counter set hit=hit+1, time='$time' where log='$dlog'";
@mysql_query($input,$connect);
}
}
###############################################################################################
//					�α׻�볡
###############################################################################################

}
#######################################################################################################
//					ī����
#######################################################################################################


####################################################################################
//					��ü�湮��
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

@set_image($counter."_today",$today);
@set_image($counter."_total",$total);
@set_image($counter."_yester",$yester);
@set_image($counter."_now",$now);
@set_image($counter."_peak",$peak);
@set_image($counter."_day_peak",$day_peak);

@mysql_close($connect);
unset($connect);

header("location:nalog_image/blank.gif");
?>