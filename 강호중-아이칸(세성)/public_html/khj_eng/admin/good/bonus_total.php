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
$sum_sql = "select sum(bonus) as bonus_total from $BonusTable where bonus > '0' and mart_id ='$mart_id'";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_total_str1 = $sum_rows[bonus_total];

$sum_sql = "select sum(bonus) as bonus_total from $BonusTable where bonus < '0' and mart_id ='$mart_id'";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_total_str2 = $sum_rows[bonus_total];
			
?>
				<p align="center"><b>[ȸ�� �����ݳ���] </b><br>
				<br>
				<b>�� ������ : <?=number_format($bonus_total_str1);?>�� &nbsp; ����������� : <?=number_format($bonus_total_str2);?>��</b>
				
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
				<!--
				<form action='bunus.html' method='post' onsubmit="return frm_val(this)">
				<input type='hidden' name='flag' value='add'>
				<input type='hidden' name='username' value='<?=$username?>'>
				<input type='hidden' name='provider_id' value='<?=$Mall_Admin_ID?>'>
				<input type='hidden' name='mode' value='<?=$mode?>'>
				<tr>
					<td align="left" width="12%" bgColor="#c8dfec">����</td>
					<td align="left" width="88%" bgColor="#ffffff" colSpan="5"><input name="content" class="input_03" size="55"> </td>
				</tr>
				<tr>
					<td align="left" width="12%" bgColor="#c8dfec">�ݾ�</td>
					<td align="left" width="88%" bgColor="#ffffff" colSpan="5">
						<select size="1" name="p_m">
						<option value="+" selected>+</option>
						<option value="-">-</option>
						</select> 
						<input name="bonus" class="input_03" size="15"> 
						<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="����Ʈ ����">
					</td>
				</tr>
				</form>
				-->
				<tr>
					<td align="middle" bgColor="#c8dfec">No.</td>
					<td align="middle" bgColor="#c8dfec">ȸ����ȣ</td>
					<td align="middle" bgColor="#c8dfec">����&nbsp;</td>
					<td align="middle" bgColor="#c8dfec">�ݾ�</td>
					<td align="middle" bgColor="#c8dfec">����</td>
					<!--
					<td align="middle" bgColor="#c8dfec">����</td>
					-->
<?


$SQL = "select * from $BonusTable where mart_id ='$mart_id' order by num desc";
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
	$id = $ary[id];
	$provider_id = $ary[provider_id];//������ ������ ȸ����
	$write_date =$ary[write_date];
	$write_date = substr($write_date,0,12);
	$bonus = $ary[bonus];
	$content = nl2br($ary[content]);
	$order_num = $ary[order_num];
	
	$bonus_str = number_format($bonus);
	//$sum = $sum + $bonus;
	$j = $numRows - $i;

?>
				<tr>
					<td align='middle' width='12%' bgColor='#ffffff'><?=$j?></td>
					<td align='middle' width='15%' bgColor='#ffffff'><?=$id?></td>
					<td align='middle' width='15%' bgColor='#ffffff'><?=$write_date?></td>
					<td align='middle' width='13%' bgColor='#ffffff'><?=$bonus_str?></td>
					<td width='15%' bgColor='#ffffff' align='center'>
					<?
					if($ary[mode]=="j"){
						echo"������";
					}elseif($ary[mode]=="u"){
						echo"ȸ���Ⱓ����";
					}elseif($ary[mode]=="uc"){
						echo "�з�����[".$content."]";
					}
					?>
					</td>
					<!--
					<td width='5%' bgColor='#ffffff' align='center'>
					<input onclick="del('<?=$rows[item_code]?>', '<?=$num?>')" style='BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white' type='button' value='����'>
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
					<a href='bonus_total.php?username=$rows[item_code]&page=1'>ó��</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=$prev_start_page'>
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
					<a href='bonus_total.php?username=$rows[item_code]&page=$i'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='bonus_total.php?username=$rows[item_code]&page=$next_start_page'>
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
					<a href='bonus_total.php?username=$rows[item_code]&page=$total_page'>��</a> 
					");
				}
				?>
				</td>
		</tr>
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff"><p align="center">
		  <input onclick='opener.window.location.reload();window.close()' style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="�ݱ�"></td>
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
	$write_date = date("Y-m-d H:i:s");
	$bonus_tmp = $bonus;
	$point_str = "a";
	if($p_m == '-'){
		$bonus = -$bonus; 
		$point_str = "d";
	}

	$SQL = "insert into $BonusTable (mart_id, provider_id, id, write_date, bonus, content, mode) ".
	"values ('$mart_id', '$provider_id', '$username', '$write_date', $bonus, '$content', '$point_str')";
	$dbresult = mysql_query($SQL, $dbconn);

	if( !$dbresult ){
		echo "
		<script>
			alert('����Ʈ �߰��� �����߽��ϴ�');
			history.go(-1);
		</script>
		";
		exit;
	}
			
	$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total + $bonus where username='$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	if( !$dbresult ){
		echo "
		<script>
			alert('ȸ���������� ����Ʈ �谨�� �����߽��ϴ�');
			history.go(-1);
		</script>
		";
		exit;
	}

	if( $mode == "point" ){
		$tl_regdate = date("Y-m-d H:i:s");

		$tl_money = $bonus;
		
		if( $bonus < 0 ){
			$tl_content = "$username ����Ʈ �Ⱓ ����� $tl_money �谨";
			$tl_ok = "���";
		}else{
			$tl_content = "$tl_money ����";
			$tl_ok = "���";			
		}
		$sql = "insert into $TicketListTable ( tl_uid, mart_id, provider_id, tl_money, tl_content, tl_memo, tl_ok,	tl_regdate, tl_getdate ) values ( '', '$mart_id', '$provider_id', '$tl_money', '$tl_content', '$tl_memo', '$tl_ok', '$tl_regdate', '$tl_regdate' )";
		$result = mysql_query($sql, $dbconn);
		if( !$result ){
			echo ("
				<script>
				alert('ȸ���� ����Ʈ ��Ͽ� ����ϴµ� �����߽��ϴ�.');
				history.go(-1);
				</script>
			");
			exit;
		}
	}

	echo "<meta http-equiv='refresh' content='0; URL=bonus_total.php?username=$username&provider_id=$provider_id&mode=$mode'>";
	
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
