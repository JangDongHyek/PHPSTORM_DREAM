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
		alert("������ �Էµ��� �ʾҽ��ϴ�.");
		f.content.focus();
		return false;
	}
	var Digit = '1234567890'

	if(f.bonus.value==""){
		alert("���� �ݾ��� �Է��ϼ���");				
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
					
					alert("���ڸ� �Է°����մϴ�.");
					f.bonus.focus();
					return false;
			} 
			ret = false;
		}
	}
}

function del(username,num){
	if(confirm("�����Ͻðڽ��ϱ�?")){
		window.location.href='job_geunroja.php?flag=del&mode=<?=$mode?>&provider_id=<?=$provider_id?>&username='+username+'&num='+num;
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











				<a href="../../admin/good/board_frame12.html">[����ȭ��ó�����ΰ���]</a>
<BR>
				<p align="center"><b>[�ٷ��� �˻� �� ����] </b>
				
				
				
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
				<form action='job_geunroja.php' method='post' onsubmit="return frm_val(this)">
				<input type='hidden' name='flag' value='add'>
				<input type='hidden' name='username' value='<?=$username?>'>
				<input type='hidden' name='provider_id' value='<?=$Mall_Admin_ID?>'>
				<input type='hidden' name='mode' value='<?=$mode?>'>


				<tr>
					<td align="left" width="12%" bgColor="#c8dfec">�оߺ��˻�</td>
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

<a href="<?=$PHP_SELF?>?search_category_num=<?=$category_num?>">[<?=$category_name?>]</a>
<?


}	

?>




					</td>
				</tr>
				</form>
				
				<tr>
					<td align="middle" bgColor="#c8dfec" width="10%">No.</td>
					<td align="middle" bgColor="#c8dfec" width="20%">�̸�</td>
					<td align="middle" bgColor="#c8dfec" width="20%">����ó</td>
					<td align="middle" bgColor="#c8dfec" width="30%">������ȣ</td>
					<td align="middle" bgColor="#c8dfec" width="30%">����</td>
					<!--
					<td align="middle" bgColor="#c8dfec">����</td>
					-->
<?

$now_date = date("Y-m-d");


if($search_category_num){
	$add_query = " and guenroja_type='$search_category_num' ";
}

$SQL = "select * from item where mart_id='$mart_id' and job_gubun='3' and  job_end_date >= '$now_date' $add_query";

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

	/*
	$SQL2 = "select * from item where item_id='$ary[you_id]'";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$rows2=mysql_fetch_array($dbresult2);
	*/


?>
				<tr>
					<td align='middle' width='10%' bgColor='#ffffff'><?=$j?></td>
					<td align='middle' width='30%' bgColor='#ffffff'>
					<a href="#" onclick="javascript:window.open('../card2.htm?item_id=<?=$ary[item_id]?>','','width=444,height=264,left=300,top=200');"><?=$name?></a>
					</td>
					<td align='middle' width='30%' bgColor='#ffffff'>
					 <?=$ary[tel]?>
					</td>
					<td align='middle' width='30%' bgColor='#ffffff'><?=$ary[sea_num]?><?=$ary[sung_num]?><?=$ary[khan_num]?><?=$ary[sudong_num]?></td>
					<td width='30%' bgColor='#ffffff' align='center'>
						<a href="<?=$PHP_SELF?>?flag=add&guin_id=<?=$item_id?>&guenroja_type=<?=$ary[guenroja_type]?>">[����]</a>  
						
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
					ó��
					");
				}
				else{
					echo ("
					<a href='job_geunroja.php?username=$rows[item_code]&page=1&search_category_num=$search_category_num'>ó��</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='job_geunroja.php?username=$rows[item_code]&page=$prev_start_page&search_category_num=$search_category_num'>
					��&nbsp; 
					</a>
					");
				}
				else{
					echo ("
					��&nbsp; 
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
					<a href='job_geunroja.php?username=$rows[item_code]&page=$i&search_category_num=$search_category_num'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='job_geunroja.php?username=$rows[item_code]&page=$next_start_page&search_category_num=$search_category_num'>
					&nbsp;��
					</a>
					");
				}
				else{
					echo ("
					&nbsp;��
					");
				}
				if($page == $total_page){
					echo ("
					��
					");
				}
				else{
					echo ("
					<a href='job_geunroja.php?username=$rows[item_code]&page=$total_page&search_category_num=$search_category_num'>��</a> 
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






<?

######################################### �ٷ��� ���� ############################################

?>



<table border="0" cellpadding="0" cellspacing="0" width="40%" bordercolorlight="#E1E1E1"  align="center">
  <tr>
	 <td vAlign="top" width="646" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td width="100%" height="20">










				<p align="center"><b>[�ٷ��� ����] </b>
				
				
				
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
				<form action='job_geunroja.php' method='post' onsubmit="return frm_val(this)">
				<input type='hidden' name='flag' value='add'>
				<input type='hidden' name='username' value='<?=$username?>'>
				<input type='hidden' name='provider_id' value='<?=$Mall_Admin_ID?>'>
				<input type='hidden' name='mode' value='<?=$mode?>'>


				<tr>
					<td align="left" width="12%" bgColor="#c8dfec">�оߺ��˻�</td>
					<td align="left" width="88%" bgColor="#ffffff" colSpan="5">						
					
<?




$SQL = "select * from job_jongmok where mart_id='$mart_id' and prevno='0' order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);

for ($i=0; $i<$numRows; $i++){
	$row = mysql_fetch_array( $dbresult );
	$category_num2 = $row[category_num];
	$category_name = $row[category_name];
?>

<a href="<?=$PHP_SELF?>?search_category_num2=<?=$category_num2?>">[<?=$category_name?>]</a>
<?


}	

?>




					</td>
				</tr>
				</form>
				
				<tr>
					<td align="middle" bgColor="#c8dfec" width="10%">No.</td>
					<td align="middle" bgColor="#c8dfec" width="20%">�̸�</td>
					<td align="middle" bgColor="#c8dfec" width="20%">����ó</td>
					<td align="middle" bgColor="#c8dfec" width="30%">������ȣ</td>
					<!--<td align="middle" bgColor="#c8dfec">����</td>
					
					<td align="middle" bgColor="#c8dfec">����</td>
					-->
<?

$now_date = date("Y-m-d");


if($search_category_num2){


	$add_query2 = " and guenroja_type='$search_category_num2' ";
}

$SQL = "select * from my_list where my_id='$_SESSION[Mall_Admin_ID]' and type='3' $add_query2";





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


	$SQL2 = "select * from item where job_gubun='3' and  job_end_date >= '$now_date' and item_id='$ary[id]'";
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
					<td align='middle' width='5%' bgColor='#ffffff'><?=$ary2[tel]?></td>
					<td align='middle' width='12%' bgColor='#ffffff'><?=$ary2[sea_num]?><?=$ary2[sung_num]?><?=$ary2[khan_num]?><?=$ary2[sudong_num]?></td>

				<!--
					<td width='20%' bgColor='#ffffff' align='center'>
						<a href="">[����]</a>  
						
					</td>
					-->
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
					ó��
					");
				}
				else{
					echo ("
					<a href='job_geunroja.php?username=$rows[item_code]&page=1&search_category_num2=$search_category_num2'>ó��</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='job_geunroja.php?username=$rows[item_code]&page=$prev_start_page&search_category_num2=$search_category_num2'>
					��&nbsp; 
					</a>
					");
				}
				else{
					echo ("
					��&nbsp; 
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
					<a href='job_geunroja.php?username=$rows[item_code]&page=$i&search_category_num2=$search_category_num2'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='job_geunroja.php?username=$rows[item_code]&page=$next_start_page&search_category_num2=$search_category_num2'>
					&nbsp;��
					</a>
					");
				}
				else{
					echo ("
					&nbsp;��
					");
				}
				if($page == $total_page){
					echo ("
					��
					");
				}
				else{
					echo ("
					<a href='job_geunroja.php?username=$rows[item_code]&page=$total_page&search_category_num2=$search_category_num2'>��</a> 
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
//type ����:1 �뿪:2 �ٷ���:3


			
			$query = "select * from $ItemTable where item_id ='$guin_id'";
			$result = mysql_query( $query, $dbconn );
			$row = mysql_fetch_array( $result );
			$num = $row[sea_num].$row[sung_num].$row[khan_num].$row[sudong_num];

			$sql1 = "select * from my_list where my_id='$_SESSION[Mall_Admin_ID]' and id='$guin_id' and num='$num' and type='3'";
			$res1 = mysql_query($sql1,$dbconn);
			$cnt1 = mysql_num_rows($res1);

			if($cnt1 > 0){
				echo("
					<script>
					alert('�̹� ����Ǿ� �ֽ��ϴ�.');
					</script>
					<meta http-equiv='refresh' content='0; URL=job_geunroja.php?username=$username&provider_id=$provider_id&mode=$mode'>
				");
				exit;
			}else{			

				$SQL = "insert into my_list (seq_num, my_id, id, num, type, guenroja_type)  values ('', '$_SESSION[Mall_Admin_ID]', '$guin_id',  '$num', '3', '$guenroja_type')";
				$dbresult = mysql_query($SQL, $dbconn);
				echo("
					<script>
					alert('����Ǿ����ϴ�.');
					</script>
					<meta http-equiv='refresh' content='0; URL=job_geunroja.php?username=$username&provider_id=$provider_id&mode=$mode'>
				");
				exit;
				}


	
}else if($flag=="del"){
	
	$SQL = "select bonus from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$bonus = mysql_result($dbresult,0,0);
	
	$SQL = "update $Mart_Member_NewTable set job_geunroja = job_geunroja - $bonus 
	where username='$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "delete from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=job_geunroja.php?username=$username&provider_id=$provider_id&mode=$mode'>";
}
?>
<?
mysql_close($dbconn);
?>
