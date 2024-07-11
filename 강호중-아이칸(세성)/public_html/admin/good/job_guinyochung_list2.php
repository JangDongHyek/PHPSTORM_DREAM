<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ""){
	include "../admin_head.php";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function selectAll() {
	var form = document.form1;

	for (i=0; i < form.elements.length; i++) {
		if (form.elements[i].name =="loan_number[]") {
			if (form.elements[i].checked == true) {
				form.elements[i].checked = false;
			}
			else{
				form.elements[i].checked = true;
			}
		}
	}
}
function execute(){
var form=document.form1;
var no_count = 0;
	for(i=0; i < form.elements.length; i++){
		if(form.elements[i].name == "loan_number[]"){
			if(form.elements[i].checked == true){
				no_count++;
			}
		}
	}

	if(no_count == 0){
		alert('선택된 항목이 없습니다');
		return;
	}
	//MM_openBrWindow('','execute','width=400,height=300,resizable=yes');

	//document.form1.target = "execute";
	//document.form1.action = "job_geunro_yochung.php";
	document.form1.submit();
}
//-->
</SCRIPT>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?include '../inc/menu3.html'; ?>
<table border="0" cellpadding="0" cellspacing="0" width="40%" bordercolorlight="#E1E1E1"  align="center">
<form name="form1" action="job_guinyochung_list2.php" method="post">
  <input type=hidden name=flag value="add">
    <input type=hidden name=sido value="<?=$sido?>">
    <input type=hidden name=gugun value="<?=$gugun?>">
    <input type=hidden name=dong value="<?=$dong?>">
    <input type=hidden name=category_num value="<?=$category_num?>">
    <input type=hidden name=ori_seq_num value="<?=$ori_seq_num?>">

<tr>
	 <td vAlign="top" width="646" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td width="100%" height="20" align=center>








					<?
						$SQL = "select category_name from job_jongmok where category_num='$category_num'";
						$dbresult = mysql_query($SQL, $dbconn);
						$row = mysql_fetch_array( $dbresult );
					?>



				<a href="../../admin/good/board_frame12.html">[관리화면처음으로가기]</a>
<BR>
				<p align="center"><b>[<?=$row[category_name]?> 근로자 선택] </b>
				
				
				
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
	
				<tr>
					<td align="middle" bgColor="#c8dfec">No.</td>
					<td align="middle" bgColor="#c8dfec">이름</td>
					<td align="middle" bgColor="#c8dfec">연락처</td>
					<td align="middle" bgColor="#c8dfec">고유번호</td>
					<td align="middle" bgColor="#c8dfec">선택</td>					
					
<?

$now_date = date("Y-m-d");


if($search_category_num){
	$add_query = " and guenroja_type='$search_category_num' ";
}

//$SQL = "select * from item where mart_id='$mart_id' and job_gubun='3' and  job_end_date >= '$now_date' and guenroja_type='$category_num'";

$SQL = "select * from my_list where my_id='$_SESSION[Mall_Admin_ID]' and type='3' and guenroja_type='$category_num'";


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
	$j = $numRows - $i;


	$SQL2 = "select * from item where job_gubun='3' and  job_end_date >= '$now_date' and item_id='$ary[id]'";
	$dbresult2 = mysql_query($SQL2,$dbconn);
	$ary2=mysql_fetch_array($dbresult2);


	$sql3 = "select * from job_geunro_yo where you_id='$ary2[item_id]' order by seq_num desc limit 1";
	$res3 = mysql_query($sql3,$dbconn);
	$row3 = mysql_fetch_array($res3);


?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'><?=$j?></td>
					<td align='middle' width='12%' bgColor='#ffffff'><?=$ary2[item_name]?></td>
					<td align='middle' width='12%' bgColor='#ffffff'><?=$ary2[tel]?></td>
					<td align='middle' width='12%' bgColor='#ffffff'><?=$ary2[sea_num]?><?=$ary2[sung_num]?><?=$ary2[khan_num]?><?=$ary2[sudong_num]?></td>
					<td width='20%' bgColor='#ffffff' align='center'>
						<?
							if($row3[auth_yn] == 'y'){
								echo "[근로중]";
						}else{
						?>
											<input type=checkbox name="loan_number[]" value="<?=$ary2[item_id]?>">		
						<?
						}
						?>					
					</td>
					
				</tr>
<?
}
?>


				</table>
				</td>
			 </tr>
		  </table>
		  </td>
		</tr>
		

		<tr align="middle">
		  <td vAlign="top" width="100%" bgColor="#ffffff"><input type=button onclick="javascript:execute();" value="요청하기"></td>
		</tr>
	 </table>
	 </td>
  </tr>
</table>
</form>
</body>
</html>
<?
			
}else if($flag=="add"){

	for($i=0; $i<sizeof($loan_number); $i++){
	
		
		$sql1 = "select * from job_geunro_yo where my_id='$_SESSION[Mall_Admin_ID]' and you_id='$loan_number[$i]' and ori_seq_num='$ori_seq_num'";
		$res2 = mysql_query($sql1,$dbconn);
		$rows1 = mysql_num_rows($res2);


		if($rows1 > 0){
					echo("
						<script>
						alert('이미 요청했습니다.');
						</script>
						<meta http-equiv='refresh' content='0; URL=job_guinyochung_list2.php?category_num=$category_num&sido=$sido&gugun=$gugun&dong=$dong&ori_seq_num=$ori_seq_num'>
					");
					exit;
		}else{
			$reg_date = date("Y-m-d H:i:s");
			$sql = "insert into job_geunro_yo (seq_num,ori_seq_num,my_id,you_id,category_num,auth_yn,sido,gugun,dong,reg_date) values ('','$ori_seq_num','$_SESSION[Mall_Admin_ID]','$loan_number[$i]','$category_num','n','$sido','$gugun','$dong','$reg_date')";
			$res = mysql_query($sql,$dbconn);
		}

	}

					echo("
						<script>
						alert('요청되었습니다.');
						</script>
						<meta http-equiv='refresh' content='0; URL=job_guinyochung_list.php'>
					");
					exit;
}
?>