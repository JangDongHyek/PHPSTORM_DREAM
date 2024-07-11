<?
####################################################################################
/*
				navyism@log analyzer 5
				  function library

*/
####################################################################################

####################################################################################
//					글로벌변수
####################################################################################
if(count($HTTP_GET_VARS)){extract($HTTP_GET_VARS);} 
if(count($HTTP_POST_VARS)){extract($HTTP_POST_VARS);}
$PHP_SELF=$HTTP_SERVER_VARS[PHP_SELF];
$HTTP_REFERER=$HTTP_SERVER_VARS[HTTP_REFERER];
$REMOTE_ADDR=$HTTP_SERVER_VARS[REMOTE_ADDR];

####################################################################################
//					버튼지정
####################################################################################
$go_root="<font color=#008CD6 size=1><a href=root.php>ROOT</a></font>";
$close="<font color=#008CD6 size=1><a href=javascript:void(0) onclick='window.close()'>CLOSE</a></font>";
$help="<font color=#008CD6 size=1><a href=http://navyism.com target=_blank>HELP</a></font>";
$manual="<font color=#008CD6 size=1><a href=http://navyism.com/support/nalog/index.html target=_blank>MANUAL</a></font>";
$logout="<font color=#008CD6 size=1><a href=logout.php onclick=\"if(confirm('message : \\n\\nlog-out?'))return true;else return false;\">LOGOUT</a></font>";

####################################################################################
//					에러메세지
####################################################################################
function nalog_error($text) 
{
echo"<script>
window.alert('error : \\n\\n$text');
history.go(-1);
</script>";
exit;
}

####################################################################################
//					일반메세지
####################################################################################
function nalog_msg($text)
{
echo"<script>
window.alert('message : \\n\\n$text');
</script>";
}

####################################################################################
//					페이지이동
####################################################################################
function nalog_go($url)
{
echo"<meta http-equiv='refresh' content='0;url=$url'>";
exit;
}

####################################################################################
//					관리자체크
####################################################################################
function nalog_admin_check($url)
{
global $admin_id,$admin_pass,$HTTP_COOKIE_VARS;
$admin=md5($admin_id.$admin_pass);
if($HTTP_COOKIE_VARS[nalog_admin]!=$admin){nalog_go("$url");}
}

####################################################################################
//					관리자체크
####################################################################################
function nalog_admin_check2()
{
global $admin_id,$admin_pass,$HTTP_COOKIE_VARS;
$admin=md5($admin_id.$admin_pass);
if($HTTP_COOKIE_VARS[nalog_admin]!=$admin){echo"<script language=javascrip>window.close()</script>";exit;}
}

####################################################################################
//					관리자체크
####################################################################################
function nalog_admin_check3()
{
global $admin_id,$admin_pass,$HTTP_COOKIE_VARS;
$admin=md5($admin_id.$admin_pass);
if($HTTP_COOKIE_VARS[nalog_admin]!=$admin){nalog_error('Permission Denied');}
}

####################################################################################
//					관리자체크
####################################################################################
function nalog_admin_check4()
{
global $admin_id,$admin_pass,$HTTP_COOKIE_VARS;
$admin=md5($admin_id.$admin_pass);
if($HTTP_COOKIE_VARS[nalog_admin]==$admin){return 1;}
}

####################################################################################
//					인덱스
####################################################################################
function nalog_index(){
global $PHP_SELF,$pagegroup,$pagestart,$pageend,$pageviewsu,$send,$pagenum,$pagesu,$total;
$file_name=$PHP_SELF;
if($pagegroup>1){
$prev=$pagestart-$pageviewsu-1;//이전목록그룹의 시작페이지결정
echo"<a href=\"$file_name?${send}pagenum=$prev\"><span style=font-size:6pt>&#9664;&#9664;</span></a> ";
}
if($pagenum){
$prevpage=$pagenum-1;
echo"<a href=\"$file_name?${send}pagenum=$prevpage\"><span style=font-size:6pt>&#9664;</span></a> ";
}
for($i=$pagestart;$i<=$pageend;$i++)
{
if($pagesu<$i){break;}
$j=$i-1;
if($j==$pagenum){echo "<b>$i</b> ";}
else{echo "[<a href=\"$file_name?${send}pagenum=$j\">$i</a>] ";}
}
if(($pagenum+1)!=$pagesu && $total){
$nextpage=$pagenum+1;
echo"<a href=\"$file_name?${send}pagenum=$nextpage\"><span style=font-size:6pt>&#9654;</span></a> ";
}
if($pageend<$pagesu){echo"<a href=\"$file_name?${send}pagenum=$pageend\"><span style=font-size:6pt>&#9654;&#9654;</span></a> ";}
}	

####################################################################################
//					카운터리스트
####################################################################################
function nalog_list_bd(){
global $connect_db;
$result = @mysql_list_tables ("$connect_db");
$i=0;
$j=0;
while ($i < @mysql_num_rows ($result)) {
$tb_names[$i] = @mysql_tablename ($result, $i);
if(eregi("nalog3_counter_",$tb_names[$i]))
{
$tb_names[$i] = str_replace( "nalog3_counter_", "",$tb_names[$i] ); 
$tables[$j] = $tb_names[$i];
$j++;
}
$i++;
}
return $tables;
}

####################################################################################
//					갯수세기
####################################################################################
function nalog_total($table,$wherelibbb){
global $connect;
$query="select count(*) from $table where 1 $wherelibbb"; 
$total=@mysql_fetch_array(mysql_query($query)); 
$total=$total["count(*)"]; 
return $total;
}

####################################################################################
//					드롭
####################################################################################
function nalog_drop($table){
global $connect;
$query="drop table $table";
$result=@mysql_query($query,$connect);
}

####################################################################################
//					설정꺼내기
####################################################################################
function nalog_config($id){
global $connect;
$query="select * from nalog3_config_$id where no=1";
$result=@mysql_fetch_array(@mysql_query($query)); 
return $result;
}

####################################################################################
//					숫자검사
####################################################################################
function nalog_chk_num($str,$length,$text1,$text2)
{
if(!ereg("^(0|[0-9]*)$",$str)){nalog_error($text1);}
if(strlen($str)<$length){nalog_error($text2);}
}	

####################################################################################
//					문자검사
####################################################################################
function nalog_chk_word($str,$word){
if(ereg("[$word]",$str)){nalog_error($error.$word.'is not available character');}
}

####################################################################################
//					문자+숫자검사
####################################################################################
function nalog_chk_str($str,$length,$text1,$text2)
{
if(!eregi("^([_0-9a-z]*)$",$str)){nalog_error($text1);}
if(strlen($str)<$length){nalog_error($text2);}
}

####################################################################################
//					문자열자르기
####################################################################################
function nalog_cut($str,$max){ 
$count = strlen($str); 
if($count >= $max) { 
for ($pos=$max;$pos>0 && ord($str[$pos-1])>=127;$pos--); 
if (($max-$pos)%2 == 0) 
$str = substr($str, 0, $max) . "..."; 
else 
$str = substr($str, 0, $max+1) . "..."; 
return $str;
} 
else { 
$str = "$str"; 
return $str;
} 
}

####################################################################################
//					os정보
####################################################################################
function set_os($os){
global $os_version,$os_name,$array;
$os_version="";

	for($i=0;$i<sizeof($array);$i++){
		$j=$i+1;
		if(eregi("$os",$array[$i]) && eregi("^[0-9]{1,2}([\.]{1}[0-9]{1,2})*[a-z]{0,1}$",$array[$j])){
		$os_version=$array[$j];
		}	
	}
}

####################################################################################
//					browser정보
####################################################################################
function set_br($br){
global $br_version,$br_name,$array;
$br_version="";

	for($i=0;$i<sizeof($array);$i++){
		$j=$i+1;
		if(eregi("$br",$array[$i]) && eregi("^[0-9]{1,2}([\.]{1}[0-9]{1,2})*[a-z]{0,1}$",$array[$j])){
		$br_version=$array[$j];
		}	
	}
}

####################################################################################
//					os+browser체크
####################################################################################
function check_agent(){
global $HTTP_SERVER_VARS,$os_name,$os_version,$br_version,$br_name,$array;

$temp=$HTTP_SERVER_VARS["HTTP_USER_AGENT"];
$temp=eregi_replace("([ 0-9\.\])*%","",$temp);
$temp=trim(eregi_replace("-|_|=|\+|;"," ",$temp));

$array=split(" ",$temp);

if(eregi("([a-z])+/",$array[0])){$br_version_temp=split("/",$array[0]);}
$br_version_temp=$br_version_temp[1];

if(eregi("Win|Window",$temp)){
$os_name="Windows";

	if(ereg("s 3\.1|n3\.1",$temp)){
	$os_version="3.1";
	}

	if(ereg("s 95|n95",$temp)){
	$os_version="95";
	}

	if(ereg("s 98|n98",$temp)){
	$os_version="98";
	}	

	if(ereg("s NT|nNT",$temp)){
	$os_version="NT";
	}

	if(ereg("s NT|nNT",$temp) && eregi("T 5\.0| 2000",$temp)){
	$os_version="2000";
	}

	if(ereg("s NT|nNT",$temp) && eregi("T 5\.1| XP",$temp)){
	$os_version="XP";
	}

	if(ereg("s CE|nCE",$temp)){
	$os_version="CE";
	}

	if(ereg("s 9x|n 9x",$temp) || eregi("me",$temp)){
	$os_version="Me";
	}
}

elseif(eregi("Mac PowerPC|PPC",$temp)){
$os_name="Mac PowerPC";
set_os("Mac powerPC");
}

elseif(eregi("Mac",$temp)){
$os_name="Macintosh";
set_os("Mac");
}

elseif(eregi("Linux",$temp)){
$os_name="Linux";
set_os("Linux");
} 

elseif(eregi("IRIX",$temp)){
$os_name="IRIX";
set_os("IRIX");
}

elseif(eregi("sunOS",$temp)){
$os_name="sunOS";
set_os("sunOS");
}

elseif(eregi("phone",$temp)){
$os_name="CellPhone";
set_os("phone");
}

else{$os_name="Unknown";$os_version="";}


if(eregi("MSN",$temp)){
$br_name="MSN";
set_br("MSN");
}

elseif(eregi("MSIE",$temp)){
$br_name="MSIE";
set_br("MSIE");
}

elseif(eregi("(\[){1}[a-z]{1,3}(\]){1}",$temp) && eregi("\]",$temp)){
$br_name="Netscape";
$br_version=$br_version_temp;
}

elseif(eregi("opera",$temp)){
$br_name="Opera";
set_br("opera");
if(!$br_version){$br_version=$br_version_temp;}
}

elseif(eregi("gec|gecko",$temp)){
$br_name="Gecko";
set_br("Gecko");
if(!$br_version){$br_version=$br_version_temp;}
}

elseif(eregi("MSMB",$temp)){
$br_name="MSMB";
}

else{$br_name="Unknown";}
}

####################################################################################
//					이미지저장
####################################################################################
function set_image($name,$counter){
global $set;
$counter_size=strlen($counter);

for($i=0;$i<$counter_size;$i++)
{
$this_number[$i]=substr($counter,$i,1);
$this_size_temp=getimagesize("skin/$set[skin]/".$this_number[$i].".jpg");
$this_width[$i]=$this_size_temp[0];
$this_height[$i]=$this_size_temp[1];
$image_width+=$this_size_temp[0];
}
$image_height=max($this_height);

$base=@imagecreate($image_width,$image_height);
if(!$base){header("location:nalog_image/error2.gif");exit;}

for($i=0;$i<$counter_size;$i++)
{
$image=imagecreatefromjpeg("skin/$set[skin]/".$this_number[$i].".jpg") or die("false 2");
imagecopyresized($base,$image,0+$sum_width,0,0,0,$this_width[$i],$this_height[$i],$this_width[$i],$this_height[$i]) or die("false 3");
$sum_width+=$this_width[$i];
imagedestroy($image);
}
imagejpeg($base,"${name}.jpg");
imagedestroy($base);
}

####################################################################################
//					쿼리생성엔진 powered by n@search 2
####################################################################################
function engine($blank_is,$column_name,$column_title,$column_memo,$from_name,$from_title,$from_memo,$word,$ban,$ns)
{
if($ban)
{
$like="not like";
$join="and";
}
else
{
$like="like";
$join="or";
}

if($ns){
$josa="의,은,는,이,가,을,를,다,이다,에,써,해,로,서,가,한,면,여,까,냐,도,나,란,요,데,고,라,세요,에서,에서도,!,\?,입니다,입니까";
$josa=explode(",",$josa);
$blank_is="and";
}

$word=stripslashes($word);


$temp=eregi_replace("(\")(.*)( +)(.*)(\")","\\2[###blank###]\\4",$word);
//$temp=eregi_replace("\(|\)|and|or"," \\0 ",$temp);
$temp=eregi_replace(" \( | \) | and | or "," \\0 ",$temp);

$temp=trim(eregi_replace(" {2,}"," ",$temp));

global $word_list;
$word_list=eregi_replace("\(|\)| and | or "," ",$temp);

$temp=explode(" ",$temp);

if($ns)
{
	for($i=0;$i<sizeof($temp);$i++)
	{
		for($k=0;$k<sizeof($josa);$k++)
		{
			if(eregi(".+$josa[$k]$",$temp[$i]))
			{
			$temp_temp=eregi_replace("$josa[$k]$","",$temp[$i]);
			if(trim($temp_temp)){$temp[$i]="( ".$temp[$i]." or ".$temp_temp." )";}
			break;
			}
		}
	}
$temp=implode(" ",$temp);
$temp=explode(" ",$temp);
}


for($i=0;$i<sizeof($temp);$i++){
if($i){


if(eregi("^\)$",$temp[$i-1]) && !eregi("^or$|^and$",$temp[$i])){$temp2[]=$blank_is;}
if(!eregi("^(\(|\)|and|or)$",$temp[$i-1]) && eregi("^\($",$temp[$i])){$temp2[]=$blank_is;}
if(!eregi("^(\(|\)|and|or)$",$temp[$i-1]) && !eregi("^(\(|\)|and|or)$",$temp[$i])){$temp2[]=$blank_is;}
}


$temp2[]=$temp[$i];
}



for($i=0;$i<sizeof($temp2);$i++){

if(eregi("^(\(|\)|and|or)$",$temp2[$i])){continue;}
unset($temp);
$temp.="(";
$temp2[$i]=addslashes($temp2[$i]);

if($from_title)
	{
	$temp.=" $column_title $like '%$temp2[$i]%'";
	}
if($from_name)
	{
	if($temp && $temp!="("){$temp.=" $join";}
	$temp.=" $column_name $like '%$temp2[$i]%'";
	}
if($from_memo)
	{
	if($temp && $temp!="("){$temp.=" $join";}
	$temp.=" $column_memo $like '%$temp2[$i]%'";
	}
$temp.=")";
$temp2[$i]=$temp;

}


$temp=implode(" ",$temp2);
$temp=str_replace("[###blank###]"," ",$temp);

return $temp;
}
?>
