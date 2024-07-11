<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ""){
	include "../admin_head.php";
?>
<script language='javascript'>

function del(username,num){
	if(confirm("삭제하시겠습니까?")){
		window.location.href='bonus_total.php?flag=del&mode=<?=$mode?>&provider_id=<?=$provider_id?>&username='+username+'&num='+num;
	}
	else return;
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?include '../inc/menu3.html'; ?>
<table border="0" cellpadding="0" cellspacing="0" width="40%" bordercolorlight="#E1E1E1"  align="center">
  <tr>
	 <td vAlign="top" width="646" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td width="100%" height="20">











<?
if($searchword && $searchword2){
	$search_qry = "and binary $keyset like '$searchword$searchword2%'";
}

$sum_sql = "select sum(bonus) as bonus_total from $BonusTable where bonus > '0' and mart_id ='$mart_id' $search_qry";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_total_str1 = $sum_rows[bonus_total];

$sum_sql = "select sum(bonus) as bonus_total from $BonusTable where bonus < '0' and mart_id ='$mart_id' $search_qry";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_total_str2 = $sum_rows[bonus_total];

			

$bonus_total_str2 = eregi_replace('[-a-z!#$%&\'*+/=?^_`{|}~<>]', '',$bonus_total_str2);



$bonus_total_str = $bonus_total_str1 - $bonus_total_str2;



?>
				<p align="center"><b>[종목 선택] </b><br>
				
				
				</td>
			 </tr>
		  </table>
		  </td>
		</tr>
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
		  <table width="97%" border="0">
			 <tr>
				<td width="100%" bgColor="#999999">
				<table cellSpacing="1" cellPadding="3" width="100%" border="0">
				<form action='<?=$PHP_SELF?>' method='post'>
				<input type='hidden' name='flag' value='add'>
				<input type='hidden' name='username' value='<?=$username?>'>
				<input type='hidden' name='provider_id' value='<?=$Mall_Admin_ID?>'>
				<input type='hidden' name='mode' value='<?=$mode?>'>


				<tr>
					<td align="left" width="12%" bgColor="#c8dfec">종목선택</td>
					<td align="left" width="88%" bgColor="#ffffff" colSpan="5">						
					
<?

$SQL = "select * from job_jongmok where mart_id='$mart_id' and prevno='0' order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);

for ($i=0; $i<$numRows; $i++){
	$row = mysql_fetch_array( $dbresult );
	$category_num = $row[category_num];
	$category_name = $row[category_name];
?>

<input type=radio name="guenroja_type" value="<?=$category_num?>"><?=$category_name?>
<?


}	

?>

&nbsp;&nbsp;
<input type=submit value="완료">


<BR>

※회원정보는 회원가입시의 정보로 자동인식 됩니다.

					</td>
				</tr>
				</form>
<!--		
				<tr>
					<td align="middle" bgColor="#c8dfec">No.</td>
					<td align="middle" bgColor="#c8dfec">이름</td>
					<td align="middle" bgColor="#c8dfec">저장</td>
		
<?

$now_date = date("Y-m-d");


$SQL = "select * from item where mart_id='$mart_id' and job_gubun='3' and job_start_date >= '$now_date' and job_end_date <= '$now_date'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if ($cnfPagecount == "") $cnfPagecount = 10;
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

$total_page = ($numRows - 1) / $cnfPagecount;
$total_page = intval($total_page)+1;

if($page % 10 == 0)
$start_page = $page - 9;
else
$start_page = $page - ($page % 10) + 1;

$end_page = $start_page + 9;
if($end_page >= $total_page)
	$end_page = $total_page;
$prev_start_page = $start_page - 10;
$next_start_page = $start_page + 10;

$sum = 0;
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$num = $ary[num];
	$mart_id = $ary[mart_id];
	$category_num = $row[category_num];
	$prevno = $row[prevno];
	$category_name = $row[category_name];
	$cat_order = $row[cat_order];
	$if_hide = $row[if_hide];
	$gigan = $row[gigan];
	$money = $row[money];
	$j = $numRows - $i;

?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'><?=$j?></td>
					<td align='middle' width='12%' bgColor='#ffffff'><?=$id?></td>
					<td width='20%' bgColor='#ffffff' align='center'>


					</td>
					</td>
				</tr>
<?
}
?>
-->

				</table>
				</td>
			 </tr>
		  </table>
		  </td>
		</tr>
		<!--
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff"><p align="right">
		  <?
				if($page == 1){
					echo ("
					처음
					");
				}
				else{
					echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=1&searchword=$searchword&searchword2=$searchword2'>처음</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=$prev_start_page&searchword=$searchword&searchword2=$searchword2'>
					◁&nbsp; 
					</a>
					");
				}
				else{
					echo ("
					◁&nbsp; 
					");
				}
				for($i=$start_page;$i<=$end_page;$i++){
					if($i == $page){
						echo ("	
						[<b>$i</b>]
						");
					}
					else{
						echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=$i&searchword=$searchword&searchword2=$searchword2'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=$next_start_page&searchword=$searchword&searchword2=$searchword2'>
					&nbsp;▷
					</a>
					");
				}
				else{
					echo ("
					&nbsp;▷
					");
				}
				if($page == $total_page){
					echo ("
					끝
					");
				}
				else{
					echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=$total_page&searchword=$searchword&searchword2=$searchword2'>끝</a> 
					");
				}
				?>
				</td>
		</tr>
	-->
		<tr align="middle">
		  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
		</tr>
	 </table>
	 </td>
  </tr>
</table>

</body>
</html>
<?
}else if($flag=="add"){
	$write_date = date("YmdHis");

	if(!$guenroja_type){
			echo("
				<script>
				alert('종목을 선택해주세요.');top.location.href='../../admin/good/job_jungong_suntaek.php';
				</script>
				
			");
			exit;
	}else{
		$sql = "update item set guenroja_type='$guenroja_type' where item_id='$_SESSION[Mall_Admin_ID]'";
		$dbresult = mysql_query($sql, $dbconn);

			echo("
				<script>
				alert('근로자 등록이 완료되었습니다.');
				</script>
				<meta http-equiv='refresh' content='0; URL=../../admin/good/board_frame12.html'>
			");
			exit;
	}



	

	
}else if($flag=="del"){
	
	$SQL = "select bonus from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$bonus = mysql_result($dbresult,0,0);
	
	$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $bonus 
	where username='$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "delete from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=bonus_total.php?username=$username&provider_id=$provider_id&mode=$mode'>";
}
?>
<?
mysql_close($dbconn);
?>
