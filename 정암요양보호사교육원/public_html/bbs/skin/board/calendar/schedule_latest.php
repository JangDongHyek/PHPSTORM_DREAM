<?
// START : DB ����
$���ȣ��Ʈ = $mysql_host;    // ��� ȣ��Ʈ����
$�����̵� = $mysql_user;              // ��� ���̵�
$����й�ȣ = $mysql_password;             // ��� ��й�ȣ
$������ = $mysql_database_name;                // ����
//echo $������;

// ���� ���� ���ϼŵ� �˴ϴ�
$connect=mysql_connect("$���ȣ��Ʈ", "$�����̵�", "$����й�ȣ");
mysql_select_db("$������", $connect);

// END : DB ����

// --------------------------------------------------------------------------- //
// START : �޷��� ������ �� �ش��, ���ۿ��� ���� ���ϴ� ������ ����             //
// --------------------------------------------------------------------------- //

//������ ���̺�� .. �Ʒ� ��� ���̺���� ���� �������ּ���. �����δ� �ȵǴ��󱸿�.
// ���̺� �̸� ����
$id = "concert1";
$_table_name = "rg_".$id."_body";
//���̺� �׵θ� Į��
$bordercolordark="#ffffff";
$bordercolorlight="white";
//���̺� ũ��
$width = "190";
$td_width ="14%";
$td_height_top="5";
$td_height="10";
//���ó�¥ ��
$today_color="#00000";
$today_out_color="#ADADAD";
$today_over_color="white";
//�Ͽ��� ��
$sun_color="##FF0000";
$sun_bgcolor="F6F6F2";
$sun_out_color="F6F6F2";
$sun_over_color="white";
//����� ��
$sat_color="#0000FF";
$sat_bgcolor="white";
$sat_out_color="F6F6F2";
$sat_over_color="white";
//������ ��¥ ��
$else_color="#000000";
$else_bgcolor="white";
$else_out_color="F6F6F2";
$else_over_color="white";

//�Ѵ��� �� ��¥ ��� �Լ�
function Month_Day($i_month,$i_year){
$day=1;
while(checkdate($i_month,$day,$i_year)){
$day++;
}
$day--;
return $day;
}

//���� ��¥�� ����Ϻ��� ���ϱ�
$today=date("Ymd");
$today_year=date("Y");
$today_month=date("m");
$today_day=date("d");

//month�� year�� �������� �����Ǿ����� ������ ���÷� ����.
if(!$month)$month=(int)$today_month;
if(!$year)$year=$today_year;


//������ ���� �� �ϼ��� ����.
$total_day=Month_Day($month,$year);

//������ ���� 1���� ������ ����. �Ͽ����� 0.
$first=date(w,mktime(0,0,0,$month,1,$year));


//�����ް� �������� ���� ��ƾ
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
// END : �޷��� ������ �� �ش��, ���ۿ��� ���� ���ϴ� ������ ����             //
// --------------------------------------------------------------------------- //
?>
<!--------------------------------------->
<!--- START : (�����, ������/������) --->
<!--------------------------------------->
<table cellspacing='0' cellpadding='0' width='<?=$width?>' border='0' align='center'>
<tr>
<td align='left' >
<a href='<?=$PHP_SELF?>?id=<?=$id?>&month=<?=$month_prev?>&year=<?=$year_prev?>'><font style='font-family:verdana;font-size:7pt;' title='<?=$year_prev?>-<?=$month_prev?>'>��</a>
<font style='font-family:verdana;font-size:7pt;' title='$year-$month'><?=$year?> | <font color=#CAA5CC><b><?=$month?></b> </font>
<a href='<?=$PHP_SELF?>?id=<?=$id?>&month=<?=$month_next?>&year=<?=$year_next?>'><font style='font-family:verdana;font-size:7pt;' title='<?=$year_next?>-<?=$month_next?>'>��</font></a>
</td>
<td align='right'><a href="<?=$site_url?>list.php?bbs_id=<?=$id?>&year=<?=$year?>&month=<?=$month?>">list</a></td>
</tr>
</table>
<!------------------------------------->
<!--- END : (�����, ������/������) --->
<!------------------------------------->
<!---------------------------------------------------->
<!--- START : �޷¸���Ʈ �����ֱ�                  --->
<!---------------------------------------------------->
<table cellspacing=0 cellpadding=0 bordercolorlight='<?=$bordercolorlight?>' bordercolordark='<?=$bordercolordark?>' width='<?=$width?>' border=1 align='center'>
<!-- START : �޷� ���� ǥ�� -->
<tr>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$sun_bgcolor?>'><font class=ver9 color='black'>��</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>��</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>ȭ</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>��</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>��</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'><font class=ver9 color='black'>��</font></td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$sat_bgcolor?>'><font class=ver9 color='black'>��</font></td>
</tr>
<!-- END : �޷� ���� ǥ�� -->
<tr>
<?

//count�� <tr>�±׸� �ѱ������ ����. �������� 7�̵Ǹ� <tr>�±׸� �����Ѵ�.
$count=0;

//ù��° �ֿ��� ��ĭ�� 1�������� ��ĭ�� ����
for($i=0; $i<$first; $i++){
echo "<td height='$td_height' width='$td_width' bgcolor='white'> </td>";
$count++;
}

// --------------------------------------------- //
// START : ��¥�� ���̺� ǥ��                  //
// --------------------------------------------- //
for($day=1;$day<=$total_day;$day++){
$count++;

//������ ��� �� ������ ǥ��
if($day==$today_day && $month==$today_month && $year==$today_year){
$m_out_color=$today_out_color;
$m_over_color=$today_over_color;
$day_color=$today_color;
}
//���� �ƴҰ��
else {
//�Ͽ���
if ($count==1){
$m_out_color=$sun_out_color;
$m_over_color=$sun_over_color;
$day_color=$sun_color;
}
//�����
elseif ($count==7){
$m_out_color=$sat_out_color;
$m_over_color=$sat_over_color;
$day_color=$sat_color;
}
//����
else {
$m_out_color=$else_out_color;
$m_over_color=$else_over_color;
$day_color=$else_color;
}
}

// $view_date = "$year/$month/$day";
// ���� �����δ� �ȵǰ� �Ʒ��� �ٲټ���.
$view_date=mktime(0,0,0,$month,$day,$year);



echo "<td valign=top bgcolor='$m_out_color' height='$td_height' width='$td_width' onMouseOut=this.style.backgroundColor='' onMouseOver=this.style.backgroundColor='$m_over_color' style='word-break:break-all;padding:0px;'>";
echo "<div align=center>";

// ���� ��Ų �ڷ���� �޷½�Ų�� rg_ext5 ���� ��¥������ �ڵ����� �־� ���� ����..

// �̺κ� ������ �߸��Ǿ �׷����ϴ�.
$query="select * from ".$_table_name." where rg_ext5='$view_date'";
$result=mysql_query($query, $connect);

// �ش����ڿ� �ڷᰡ ������� * ǥ��
if($data=mysql_fetch_array($result)){
$doc_num2=$data[rg_doc_num];

$rg_content = $data[rg_content];

// ������ �������� ��ο� �°� �������ּ���.
echo "<A HREF='{$site_url}view.php?bbs_id=$id&doc_num=$doc_num2' onfocus=blur() title='$rg_content'><div align=center><font  color='$day_color'><b><U><I>$day</I></U></b></font></a>" ;
}
else
	echo "<font  color='$day_color'>$day</font>";

echo "</div></td>";

//���������� ���
if($count==7 && $day == $total_day ){
echo"</tr>";
}
//������� �Ǹ� �ٹٲٱ� ���� <tr>�±� ����
elseif($count==7){
echo "</tr><tr>";
$count=0;
}
}
// --------------------------------------------- //
// END : ��¥�� ���̺� ǥ��                    //
// --------------------------------------------- //
?>
<?
// ������ ���� �������� ������ �� �� ����
for($day++; $total_day < $day && $count<7; ){
echo "<td height='$td_height' width='$td_width' bgcolor='white'> </td>";
$count++;
}
echo "</table>";
?>
