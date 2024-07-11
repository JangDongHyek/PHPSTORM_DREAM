<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ""){
	include "../admin_head.php";
?>
<script language='javascript'>
function frm_val(f){

	if(f.content.value==""){
		alert("내용이 입력되지 않았습니다.");
		f.content.focus();
		return false;
	}
	var Digit = '1234567890'

	if(f.bonus.value==""){
		alert("지급 금액을 입력하세요");				
		f.bonus.focus();
		return false;				
		
	}
	else{
		var len =f.bonus.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
		    var ch = f.bonus.value.substring(i,i+1);
		    
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("숫자만 입력가능합니다.");
					f.bonus.focus();
					return false;
			} 
			ret = false;
		}
	}
}

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
				<td width="100%" height="20" align=center>

<!--
				<a href="../../admin/good/board_frame12.html">[관리화면처음으로가기]</a>
<BR>
				<p align="center"><b>[용역 지원요청 리스트] </b><br>
		-->
		

		<a href='../../admin/good/job_yongyeok_yochung.php' target='_top'><font size=3><b>[용역지원요청관리]</b></font></a> <a href='../../admin/good/board_frame12.html' target='_top'><font size=3><b>[근무현황]</b></font></a>


				
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
					<td align="middle" bgColor="#c8dfec">용역지원요청받음</td>
					<td align="middle" bgColor="#c8dfec">지역</td>
					<td align="middle" bgColor="#c8dfec">상태</td>

<?

$now_date = date("Y-m-d");


if($search_category_num){
	$add_query = " and guenroja_type='$search_category_num' ";
}

$SQL = "select * from job_geunro_yo where you_id='$_SESSION[Mall_Admin_ID]'";




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
	$name = $ary[item_name ];
	$mart_id = $ary[mart_id];
	$category_num = $row[category_num];
	$prevno = $row[prevno];
	$category_name = $row[category_name];
	$cat_order = $row[cat_order];
	$if_hide = $row[if_hide];
	$gigan = $row[gigan];
	$money = $row[money];
	$j = $numRows - $i;



	//용역업체 이름구하기
	$sql11 = "select * from item where item_id = '$ary[my_id]' ";
	$res11 = mysql_query($sql11);		
	$ary11=mysql_fetch_array($res11);


?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'><?=$j?></td>
					<td align='middle' width='12%' bgColor='#ffffff'><a href="#" onclick="javascript:window.open('../card2.htm?item_id=<?=$ary11[item_id]?>','','width=444,height=264,left=300,top=200');"><?=$ary11[item_name]?></a></td>
					<td align='middle' width='12%' bgColor='#ffffff'><?=$ary[sido]?> <?=$ary[gugun]?> <?=$ary[dong]?></td>
					<td align='middle' width='12%' bgColor='#ffffff'>
					<?
					if($ary[auth_yn] == 'y'){
					?>
					[승인함]
					<?
					}elseif($ary[auth_yn] == 'c'){
					?>
					[거절함]
					<?}else{?>
					<a href="<?=$PHP_SELF?>?flag=add&seq_num=<?=$ary[seq_num]?>">[승인하기]</a>
					<?}?>
					</td>
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
					<a href='bonus_total.php?username=$rows[item_code]&page=1&searchword=$searchword&searchword2=$searchword2&search_category_num=$search_category_num'>처음</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=$prev_start_page&searchword=$searchword&searchword2=$searchword2&search_category_num=$search_category_num'>
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
					<a href='bonus_total.php?username=$rows[item_code]&page=$i&searchword=$searchword&searchword2=$searchword2&search_category_num=$search_category_num'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=$next_start_page&searchword=$searchword&searchword2=$searchword2&search_category_num=$search_category_num'>
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
					<a href='bonus_total.php?username=$rows[item_code]&page=$total_page&searchword=$searchword&searchword2=$searchword2&search_category_num=$search_category_num'>끝</a> 
					");
				}
				?>
				</td>
		</tr>

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
	

		$sql = "select * from job_geunro_yo where seq_num='$seq_num'";
		$res = mysql_query($sql,$dbconn);
		$ary=mysql_fetch_array($res);


		//여러요청중 승인된것만 y 나머지는 거절 x
		$sql = "update job_geunro_yo set auth_yn='x' where auth_yn!='y' and category_num='$ary[category_num]' and you_id='$_SESSION[Mall_Admin_ID]'";
		$res = mysql_query($sql,$dbconn);

		$sql = "update job_geunro_yo set auth_yn='y' where ori_seq_num='$ary[ori_seq_num]' and seq_num='$seq_num'";
		$res = mysql_query($sql,$dbconn);

		echo("
			<script>
			alert('요청되었습니다.');
			</script>
			<meta http-equiv='refresh' content='0; URL=job_yongyeok_yochung.php?username=$username&provider_id=$provider_id&mode=$mode'>
		");
		exit;

}
?>
<?
mysql_close($dbconn);
?>
