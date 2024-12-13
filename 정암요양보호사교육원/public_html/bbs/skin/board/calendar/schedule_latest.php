<?
// START : DB 연결
$디비호스트 = $mysql_host;    // 디비 호스트네임
$디비아이디 = $mysql_user;              // 디비 아이디
$디비비밀번호 = $mysql_password;             // 디비 비밀번호
$디비네임 = $mysql_database_name;                // 디비명
//echo $디비네임;

// 여긴 수정 안하셔도 됩니다
$connect=mysql_connect("$디비호스트", "$디비아이디", "$디비비밀번호");
mysql_select_db("$디비네임", $connect);

// END : DB 연결

// --------------------------------------------------------------------------- //
// START : 달력의 디자인 및 해당월, 시작요일 등을 구하는 변수값 선언             //
// --------------------------------------------------------------------------- //

//연결할 테이블명 .. 아래 몇군데 테이블명을 직접 수정해주세요. 변수로는 안되더라구요.
// 테이블 이름 수정
$id = "concert1";
$_table_name = "rg_".$id."_body";
//테이블 테두리 칼라
$bordercolordark="#ffffff";
$bordercolorlight="white";
//테이블 크기
$width = "190";
$td_width ="14%";
$td_height_top="5";
$td_height="10";
//오늘날짜 색
$today_color="#00000";
$today_out_color="#ADADAD";
$today_over_color="white";
//일요일 색
$sun_color="##FF0000";
$sun_bgcolor="F6F6F2";
$sun_out_color="F6F6F2";
$sun_over_color="white";
//토요일 색
$sat_color="#0000FF";
$sat_bgcolor="white";
$sat_out_color="F6F6F2";
$sat_over_color="white";
//나머지 날짜 색
$else_color="#000000";
$else_bgcolor="white";
$else_out_color="F6F6F2";
$else_over_color="white";

//한달의 총 날짜 계산 함수
function Month_Day($i_month,$i_year){
$day=1;
while(checkdate($i_month,$day,$i_year)){
$day++;
}
$day--;
return $day;
}

//오늘 날짜를 년월일별로 구하기
$today=date("Ymd");
$today_year=date("Y");
$today_month=date("m");
$today_day=date("d");

//month와 year의 변수값이 지정되어있지 않으면 오늘로 지정.
if(!$month)$month=(int)$today_month;
if(!$year)$year=$today_year;


//선택한 월의 총 일수를 구함.
$total_day=Month_Day($month,$year);

//선택한 월의 1일의 요일을 구함. 일요일은 0.
$first=date(w,mktime(0,0,0,$month,1,$year));


//지난달과 다음달을 보는 루틴
$year_p=$year-1;
$year_n=$year+1;
if($month==1){
$year_prev=$year_p;
$year_next=$year;
$month_prev=12;
$month_next=$month+1;
}
if($month==12){
$year_prev=$year;
$year_next=$year_n;
$month_prev=$month-1;
$month_next=1;
}
if($month!=1 && $month!=12){
$year_prev=$year;
$year_next=$year;
$month_prev=$month-1;
$month_next=$month+1;
}

// --------------------------------------------------------------------------- //
// END : 달력의 디자인 및 해당월, 시작요일 등을 구하는 변수값 선언             //
// --------------------------------------------------------------------------- //
?>
<!--------------------------------------->
<!--- START : (년월일, 이전달/다음달) --->
<!--------------------------------------->
<table cellspacing='0' cellpadding='0' width='<?=$width?>' border='0' align='center'>
<tr>
<td align='left' >
<a href='<?=$PHP_SELF?>?id=<?=$id?>&month=<?=$month_prev?>&year=<?=$year_prev?>'><font style='font-family:verdana;font-size:7pt;' title='<?=$year_prev?>-<?=$month_prev?>'>◁</a>
<font style='font-family:verdana;font-size:7pt;' title='$year-$month'><?=$year?> | <font color=#CAA5CC><b><?=$month?></b> </font>
<a href='<?=$PHP_SELF?>?id=<?=$id?>&month=<?=$month_next?>&year=<?=$year_next?>'><font style='font-family:verdana;font-size:7pt;' title='<?=$year_next?>-<?=$month_next?>'>▷</font></a>
</td>
<td align='right'><a href="<?=$site_url?>list.php?bbs_id=<?=$id?>&year=<?=$year?>&month=<?=$month?>">list</a></td>
</tr>
</table>
<!------------------------------------->
<!--- END : (년월일, 이전달/다음달) --->
<!------------------------------------->
<!---------------------------------------------------->
<!--- START : 달력리스트 보여주기                  --->
<!---------------------------------------------------->
<table cellspacing=0 cellpadding=0 bordercolorlight='<?=$bordercolorlight?>' bordercolordark='<?=$bordercolordark?>' width='<?=$width?>' border=1 align='center'>
<!-- START : 달력 요일 표시 -->
<tr>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$sun_bgcolor?>'><font class=ver9 color='black'>일</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>월</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>화</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>수</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>목</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>금</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$sat_bgcolor?>'><font class=ver9 color='black'>토</font></td>
</tr>
<!-- END : 달력 요일 표시 -->
<tr>
<?

//count는 <tr>태그를 넘기기위한 변수. 변수값이 7이되면 <tr>태그를 삽입한다.
$count=0;

//첫번째 주에서 빈칸을 1일전까지 빈칸을 삽입
for($i=0; $i<$first; $i++){
echo "<td height='$td_height' width='$td_width' bgcolor='white'> </td>";
$count++;
}

// --------------------------------------------- //
// START : 날짜를 테이블에 표시                  //
// --------------------------------------------- //
for($day=1;$day<=$total_day;$day++){
$count++;

//오늘일 경우 셀 디자인 표시
if($day==$today_day && $month==$today_month && $year==$today_year){
$m_out_color=$today_out_color;
$m_over_color=$today_over_color;
$day_color=$today_color;
}
//오늘 아닐경우
else {
//일요일
if ($count==1){
$m_out_color=$sun_out_color;
$m_over_color=$sun_over_color;
$day_color=$sun_color;
}
//토요일
elseif ($count==7){
$m_out_color=$sat_out_color;
$m_over_color=$sat_over_color;
$day_color=$sat_color;
}
//평일
else {
$m_out_color=$else_out_color;
$m_over_color=$else_over_color;
$day_color=$else_color;
}
}

// $view_date = "$year/$month/$day";
// 위의 것으로는 안되고 아래로 바꾸세요.
$view_date=mktime(0,0,0,$month,$day,$year);



echo "<td valign=top bgcolor='$m_out_color' height='$td_height' width='$td_width' onMouseOut=this.style.backgroundColor='' onMouseOver=this.style.backgroundColor='$m_over_color' style='word-break:break-all;padding:0px;'>";
echo "<div align=center>";

// 알지 스킨 자료실의 달력스킨은 rg_ext5 값에 날짜정보를 자동으로 넣어 쓰기 땜에..

// 이부분 쿼리가 잘못되어서 그렇습니다.
$query="select * from ".$_table_name." where rg_ext5='$view_date'";
$result=mysql_query($query, $connect);

// 해당일자에 자료가 있을경우 * 표시
if($data=mysql_fetch_array($result)){
$doc_num2=$data[rg_doc_num];

$rg_content = $data[rg_content];

// 본인의 알지보드 경로에 맞게 수정해주세요.
echo "<A HREF='{$site_url}view.php?bbs_id=$id&doc_num=$doc_num2' onfocus=blur() title='$rg_content'><div align=center><font  color='$day_color'><b><U><I>$day</I></U></b></font></a>" ;
}
else
	echo "<font  color='$day_color'>$day</font>";

echo "</div></td>";

//마지막주의 경우
if($count==7 && $day == $total_day ){
echo"</tr>";
}
//토요일이 되면 줄바꾸기 위한 <tr>태그 삽입
elseif($count==7){
echo "</tr><tr>";
$count=0;
}
}
// --------------------------------------------- //
// END : 날짜를 테이블에 표시                    //
// --------------------------------------------- //
?>
<?
// 선택한 월의 마지막날 이후의 빈 셀 삽입
for($day++; $total_day < $day && $count<7; ){
echo "<td height='$td_height' width='$td_width' bgcolor='white'> </td>";
$count++;
}
echo "</table>";
?>
