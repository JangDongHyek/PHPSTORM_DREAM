<?
//  DB 연결 : 직접 입력해주세요 id, password, dbname
$connect=mysql_connect($mysql_host, $mysql_user, $mysql_password);
mysql_select_db($mysql_database_name, $connect);

//테이블 크기
$width = "160";
$td_width ="14%";
$td_height_top="5";
$td_height="10";
//일요일 색
$sun_color="#DE8E9C";
$sun_bgcolor="white";
$sun_out_color="white";
$sun_over_color="white";
//토요일 색
$sat_color="#99CCCC";
$sat_bgcolor="white";
$sat_out_color="white";
$sat_over_color="white";
//나머지 날짜 색
$else_color="#cccccc";
$else_bgcolor="white";
$else_out_color="white";
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

//선택한 월의 총 일수를 구함.
$total_day=Month_Day($prevmonth,$prevyear);

//선택한 월의 1일의 요일을 구함. 일요일은 0.
$first=date(w,mktime(0,0,0,$prevmonth,1,$prevyear));
?>
<fieldset style="width:<?=$width?>;padding:5px">
<legend> <a href=list.php?bbs_id=<?=$bbs_id?>&year=<?=$prevyear?>&month=<?=$prevmonth?>><span style='font-family:verdana;font-size:9pt;'><?=$prevyear?>. <?=$prevmonth?>월</span></a> </legend>
<table cellspacing=0 cellpadding=0 width='<?=$width?>' border=0 align='center'>
<tr>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$sun_bgcolor?>' style="color:<?=$sun_color?>">일</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>월</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>화</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>수</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>목</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>금</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$sat_bgcolor?>'>토</td>
</tr>
<tr>
<?
//count는 <tr>태그를 넘기기위한 변수. 변수값이 7이되면 <tr>태그를 삽입한다.
$count=0;

//첫번째 주에서 빈칸을 1일전까지 빈칸을 삽입
for($i=0; $i<$first; $i++){
echo "<td height='$td_height' width='$td_width' bgcolor='white'> </td>";
$count++;
}

for($day=1;$day<=$total_day;$day++){
$count++;

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

echo "<td align=center valign=top bgcolor='$m_out_color' height='$td_height' width='$td_width' onMouseOut=this.style.backgroundColor='' onMouseOver=this.style.backgroundColor='$m_over_color' style='word-break:break-all;padding:0px;'>";


// 알지 스킨 자료실의 달력스킨은 rg_ext5 값에 날짜정보를 자동으로 넣어 쓰기 땜에..
$view_date=mktime(0,0,0,$prevmonth,$day,$prevyear);
$query="select * from ".$_table_name."_body where rg_ext5='$view_date'";
$result=mysql_query($query, $connect);

// 해당일자에 자료가 있을경우
if($data=mysql_fetch_array($result)){
echo "<A HREF='./view.php?bbs_id={$bbs_id}&doc_num=$data[rg_doc_num]'  onfocus=blur() title='$data[rg_title]'><font  color='$day_color'><u>$day</u></font></a>" ;
} else {
echo "<font  color='$day_color'>$day</font>";
}
echo "</td>";

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
?>
<?
// 선택한 월의 마지막날 이후의 빈 셀 삽입
for($day++; $total_day < $day && $count<7; ){
echo "<td height='$td_height' width='$td_width' bgcolor='white'> </td>";
$count++;
}
echo "</table></fieldset>";
?>