<?
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
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
	echo"<a href='../../admin/good/job_yongyeok.php' target='_top'><font size=3><b>[용역업체관리]</b></a>";
}elseif($job_gubun==2){
	echo"<a href='../../admin/good/job_geunroja.php' target='_top'><font size=3><b>[근로자관리] </b></font></a><a href='../../admin/good/job_guin.php' target='_top'><font size=3><b>[구인업체관리]</b></font></a><a href='../../admin/good/job_guinyochung_list.php' target='_top'><font size=3><b>[구인요청관리]</b></font></a>";
}elseif($job_gubun==3){
	echo"<a href='../../admin/good/job_yongyeok_yochung.php' target='_top'><font size=3><b>[용역지원요청관리]</b></font></a> <a href='../../admin/good/board_frame12.html' target='_top'><font size=3><b>[근무현황]</b></font></a>";
}else{
    echo"<a href='../../admin/good/job_yongyeok.php' target='_top'><font size=3><b>[용역업체관리]</b></a>";
}
?>
</td>
</tr>
</table>


<?
mysql_close($dbconn);
?>