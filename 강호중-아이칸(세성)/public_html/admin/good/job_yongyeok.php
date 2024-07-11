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
				<td width="100%" height="20">


				<p align="center"><b>[용역업체검색] </b><br>
					
				<a href="../../admin/good/board_frame12.html">[관리화면처음으로가기]</a>

				
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
					<td align="middle" bgColor="#c8dfec">업체명</td>
					<td align="middle" bgColor="#c8dfec">저장</td>

<?

$now_date = date("Y-m-d");


//if($search_category_num){
//	$add_query = " and guenroja_type='$search_category_num' ";
//}

$SQL = "select * from item where mart_id='$mart_id' and job_gubun='2' and  job_end_date >= '$now_date' $add_query";



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
	$item_id = $ary[item_id ];
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

?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'><?=$j?></td>
					<td align='middle' width='12%' bgColor='#ffffff'><a href="#" onclick="javascript:window.open('../card2.htm?item_id=<?=$ary[item_id]?>','','width=444,height=264,left=300,top=200');"><?=$name?></a></td>
					<td width='20%' bgColor='#ffffff' align='center'>
						<a href="<?=$PHP_SELF?>?flag=add&guin_id=<?=$item_id?>">[저장]</a>  
						
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
				<p align="center"><b>[용역업체관리] </b><br>
					

				
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
					<td align="middle" bgColor="#c8dfec">업체명</td>
					<td align="middle" bgColor="#c8dfec">용역업체 지원요청</td>
					<td align="middle" bgColor="#c8dfec">월별요청용역보기</td>

<?

$now_date = date("Y-m-d");


//if($search_category_num){
//	$add_query = " and guenroja_type='$search_category_num' ";
//}


$SQL = "select * from my_list where my_id='$_SESSION[Mall_Admin_ID]' and type='2'";
//$SQL = "select * from item where mart_id='$mart_id' and job_gubun='1' and  job_end_date >= '$now_date' $add_query";



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


	$SQL2 = "select * from item where job_gubun='2' and  job_end_date >= '$now_date' and item_id='$ary[id]'";
	$dbresult2 = mysql_query($SQL2,$dbconn);
	$ary2=mysql_fetch_array($dbresult2);



	$num = $ary2[num];
	$name = $ary2[item_name ];
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
					<td align='middle' width='12%' bgColor='#ffffff'><a href="#" onclick="javascript:window.open('../card2.htm?item_id=<?=$ary2[item_id]?>','','width=444,height=264,left=300,top=200');"><?=$name?></a></td>
					<td width='20%' bgColor='#ffffff' align='center'>



						<?
						$sql3 = "select * from job_yong_guyo where my_id='$_SESSION[Mall_Admin_ID]' and you_id='$ary2[item_id]'";
						$res3 = mysql_query($sql3,$dbconn);
						$ary3=mysql_fetch_array($res3);
							 							
						?>

						<?
						if($ary3[state] == "1"){	
						?>
							[요청중]
						<?
						}elseif($ary3[state] == "2"){	
						?>
							<a href="./job_gongsu.php?seq_num=<?=$ary3[seq_num]?>">[지원받음]</a>  	
						<?
						}elseif($ary3[state] == "3"){	
						?>
							[거래완료]
						<?
						}else{
						?>	
						<a href="./job_yongyeok_guinyochung.php?item_id=<?=$ary[id]?>">[요청]</a>  	
						<?}?>
						


					</td>
					<td align='middle' width='12%' bgColor='#ffffff'><a href="./job_month_list_guin.php?id=<?=$ary[id]?>">[보기]</a></td>
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
//type 구인:1 용역:2 근로자:3


			
			$query = "select * from $ItemTable where item_id ='$guin_id'";
			$result = mysql_query( $query, $dbconn );
			$row = mysql_fetch_array( $result );
			$num = $row[sea_num].$row[sung_num].$row[khan_num].$row[sudong_num];

			$sql1 = "select * from my_list where my_id='$_SESSION[Mall_Admin_ID]' and id='$guin_id' and num='$num' and type='2'";
			$res1 = mysql_query($sql1,$dbconn);
			$cnt1 = mysql_num_rows($res1);

			if($cnt1 > 0){
				echo("
					<script>
					alert('이미 저장되어 있습니다.');
					</script>
					<meta http-equiv='refresh' content='0; URL=job_yongyeok.php?username=$username&provider_id=$provider_id&mode=$mode'>
				");
				exit;
			}else{			

				$SQL = "insert into my_list (seq_num, my_id, id, num, type)  values ('', '$_SESSION[Mall_Admin_ID]', '$guin_id',  '$num', '2')";
				$dbresult = mysql_query($SQL, $dbconn);
				echo("
					<script>
					alert('저장되었습니다.');
					</script>
					<meta http-equiv='refresh' content='0; URL=job_yongyeok.php?username=$username&provider_id=$provider_id&mode=$mode'>
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
