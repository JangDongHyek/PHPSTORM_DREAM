<?
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
//include "../../main.class.fnc.php";

?>
<table width=100%>
<tr>
<td align=center>
<?
	
$sql = "select * from item where item_id='$_SESSION[Mall_Admin_ID]'";
$dbresult = mysql_query($sql, $dbconn);
$rows = mysql_fetch_array($dbresult);

$job_gubun = $rows['job_gubun'];

if($job_gubun==1){
	echo"<a href='../../admin/good/job_yongyeok.php' target='_top'><font size=3><b>[�뿪��ü����]</b></a>";
}elseif($job_gubun==2){
	echo"<a href='../../admin/good/job_geunroja.php' target='_top'><font size=3><b>[�ٷ��ڰ���] </b></font></a><a href='../../admin/good/job_guin.php' target='_top'><font size=3><b>[���ξ�ü����]</b></font></a><a href='../../admin/good/job_guinyochung_list.php' target='_top'><font size=3><b>[���ο�û����]</b></font></a>";
}elseif($job_gubun==3){
	echo"<a href='../../admin/good/job_yongyeok_yochung.php' target='_top'><font size=3><b>[�뿪������û����]</b></font></a> <a href='../../admin/good/board_frame12.html' target='_top'><font size=3><b>[�ٹ���Ȳ]</b></font></a>";
}else{
    echo"<a href='../../admin/good/job_yongyeok.php' target='_top'><font size=3><b>[�뿪��ü����]</b></a>";
}
?>
</td>
</tr>
</table>


<?
mysql_close($dbconn);
?>