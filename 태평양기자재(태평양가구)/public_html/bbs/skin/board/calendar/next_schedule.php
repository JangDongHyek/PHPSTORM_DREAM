<?
//������ ���� �� �ϼ��� ����.
$total_day2=Month_Day($nextmonth,$nextyear);

//������ ���� 1���� ������ ����. �Ͽ����� 0.
$first2=date(w,mktime(0,0,0,$nextmonth,1,$nextyear));
?>
<fieldset style="width:<?=$width?>;padding:5px">
<legend> <a href=list.php?bbs_id=<?=$bbs_id?>&year=<?=$nextyear?>&month=<?=$nextmonth?>><span style='font-family:verdana;font-size:9pt;'><?=$nextyear?>. <?=$nextmonth?>��</span></a> </legend>
<table cellspacing=0 cellpadding=0 width='<?=$width?>' border=0 align='center'>
<tr>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$sun_bgcolor?>' style="color:<?=$sun_color?>">��</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>��</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>ȭ</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>��</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>��</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$else_bgcolor?>'>��</td>
<td align=center height='<?=$td_height_top?>' width='<?=$td_width?>' bgcolor='<?=$sat_bgcolor?>'>��</td>
</tr>
<tr>
<?
//count�� <tr>�±׸� �ѱ������ ����. �������� 7�̵Ǹ� <tr>�±׸� �����Ѵ�.
$count=0;

//ù��° �ֿ��� ��ĭ�� 1�������� ��ĭ�� ����
for($i=0; $i<$first2; $i++){
echo "<td height='$td_height' width='$td_width' bgcolor='white'> </td>";
$count++;
}

for($day=1;$day<=$total_day2;$day++){
$count++;

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

echo "<td align=center valign=top bgcolor='$m_out_color' height='$td_height' width='$td_width' onMouseOut=this.style.backgroundColor='' onMouseOver=this.style.backgroundColor='$m_over_color' style='word-break:break-all;padding:0px;'>";


// ���� ��Ų �ڷ���� �޷½�Ų�� rg_ext5 ���� ��¥������ �ڵ����� �־� ���� ����..
$view_date=mktime(0,0,0,$nextmonth,$day,$nextyear);
$query="select * from ".$_table_name."_body where rg_ext5='$view_date'";
$result=mysql_query($query, $connect);

// �ش����ڿ� �ڷᰡ ������� * ǥ��
if($data=mysql_fetch_array($result)){
echo "<A HREF='./view.php?bbs_id={$bbs_id}&doc_num=$data[rg_doc_num]'  onfocus=blur() title='$data[rg_title]'><font  color='$day_color'><u>$day</u></font></a>" ;
} else {
echo "<font  color='$day_color'>$day</font>";
}
echo "</td>";

//���������� ���
if($count==7 && $day == $total_day2 ){
echo"</tr>";
}
//������� �Ǹ� �ٹٲٱ� ���� <tr>�±� ����
elseif($count==7){
echo "</tr><tr>";
$count=0;
}
}
?>
<?
// ������ ���� �������� ������ �� �� ����
for($day++; $total_day2 < $day && $count<7; ){
echo "<td height='$td_height' width='$td_width' bgcolor='white'> </td>";
$count++;
}
echo "</table></fieldset>";
?>