<?
include_once "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ""){
    include_once "../admin_head.php";
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
		window.location.href='bonus_tree.php?flag=del&mode=<?=$mode?>&provider_id=<?=$provider_id?>&username='+username+'&num='+num;
	}
	else return;
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?//include '../inc/menu3.html'; ?>
<table border="0" cellpadding="0" cellspacing="0" width="98%" bordercolorlight="#E1E1E1"  align="center">
  <tr>
	 <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td height="20">
<!--

<form name="frmList" action='<?=$PHP_SELF?>?page=<?=$page?>' method="post">


<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0" class="box2">
<input type="hidden" name="page" value="1">
<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
<input type=hidden name="keyset" value="write_date">	
<input type=hidden name="my_list" value="<?=$my_list?>">	



 
	<tr>
      <td align=center width=15% class="title">�����˻�</td> 
      <td width=35% bgcolor="#FFFFFF">
								<select name='searchword'>	
									<?
									for($i=2017;$i<=date("Y");$i++){
									?>
										<option value="<?=$i?>"><?=$i?></option>
									<?
									}
									?>
								</select>��						
								<select name='searchword2'>	
									<?
									for($z=1;$z<=12;$z++){
										$y = str_pad( $z, 2, "0", STR_PAD_LEFT );
									?>
										<option value="<?=$y?>"><?=$y?></option>
									<?
									}
									?>
								</select>��
&nbsp;&nbsp;

								<input type='image' src='../image/bu_search3.gif' hspace='10' border='0' align='absmiddle' onfocus='blur();'> <a href='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>'><img src='../image/bu_cancel2.gif' border='0' align='absmiddle' onfocus='blur();'></a>
			</td>
     
    </tr>

</table>

						

</form>

-->









<?
if(!$pu){
	$pu=3;
}


if($category_num){
	$SQL = "select * from $CategoryTable where category_num='$category_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);

	
	if( $pu == 1 ){ //1�� �׷� ����Ʈ �϶�	
		$id_sum = $rows[sea_num];
		$con = "and id like '$id_sum%'";			
	}else if( $pu == 2 ){ //2�� �׷� ����Ʈ �϶�
		$id_sum = $rows[sea_num].$rows[sung_num];
		$con = "and id like '$id_sum%'";			
	}else if($pu == 3){ //3�� �׷� ����Ʈ �϶�
		$id_sum = $rows[sea_num].$rows[sung_num].$rows[khan_num];
		$con = "and id like '$id_sum%'";			
	}
}


if($type == "c"){//�����ݰ���
	$type_qry = " and (mode='us' or mode='ug' or mode='j') ";
}elseif($type == "j"){//�������
	$type_qry = " and mode='ji' ";
}elseif($type == "g"){//������
	$type_qry = " and mode='gi' ";
}elseif($type == "m"){//ȸ���Ⱓ����
	$type_qry = " and mode='u' ";
}elseif($type == "h"){//ȯ����û
	$type_qry = " and mode='us' and hwanjun='y'";
}


if($searchword && $searchword2){
	$search_qry = "and binary $keyset like '$searchword$searchword2%'";
}

$sum_sql = "select sum(bonus) as bonus_tree from $BonusTable where length(id) = '12' and bonus > '0' and mart_id ='$mart_id' $search_qry $type_qry $con";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_tree_str1 = $sum_rows[bonus_tree];

$sum_sql = "select sum(bonus) as bonus_tree from $BonusTable where length(id) = '12' and bonus < '0' and mart_id ='$mart_id' $search_qry $type_qry $con";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_tree_str2 = $sum_rows[bonus_tree];

			

$bonus_tree_str2 = eregi_replace('[-a-z!#$%&\'*+/=?^_`{|}~<>]', '',$bonus_tree_str2);



$bonus_tree_str = $bonus_tree_str1 - $bonus_tree_str2;

if($type == "h"){//ȯ����û�� �������� - ȯ����û�ݾ� �ؼ� �����ֱ�
	$sql = "select sum(bonus) as bonus_total from bonus where length(id) = '12' and bonus > '0' and mart_id ='khj' and (mode='us' or mode='ug' or mode='j')";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);
	$tot1 = $rows[bonus_total];

	$sql = "select sum(bonus) as bonus_total from bonus where length(id) = '12' and bonus < '0' and mart_id ='khj' and (mode='us' or mode='ug' or mode='j')";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);
	$tot2 = $rows[bonus_total];

	$sql = "select sum(bonus) as bonus_total from bonus where length(id) = '12' and mode='us' and hwanjun='y'";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);
	$tot3 = $rows[bonus_total];
	
	$bonus_total_str = $tot1+$tot2+$tot3;

}

	
	$sql = "select sum(bonus) as bonus_total from bonus where id='$id_sum'";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);
	$grsum = $rows[bonus_total];

?>

				���� : <a href="./bonus_tree.php?pu=<?=$pu?>&type=c"><b>[������]</b></a>&nbsp;<a href="./bonus_tree.php?pu=<?=$pu?>&type=j"><b>[�������]</b></a>&nbsp;<a href="./bonus_tree.php?pu=<?=$pu?>&type=g"><b>[������]</b></a>&nbsp;<a href="./bonus_tree.php?type=m"><b>[ȸ���Ⱓ����]</b></a>
&nbsp;<a href="./bonus_total.php?type=h"><b>[ȯ����û]</b></a>
				<BR>
				<!--�� ������ : <?=number_format($bonus_tree_str1);?>�� &nbsp; ����������� : <?=number_format($bonus_tree_str2);?>�� =--> <b>�հ� : <?=number_format($bonus_tree_str);?>��</b>
				</td>
				<td align=right>
				<?if($category_num > 0){?>
				�׷��� ����Ʈ�հ� : <?=number_format($grsum)?>
				<?}?>
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
					<td align="middle" bgColor="#c8dfec">ȸ����ȣ</td>
					<td align="middle" bgColor="#c8dfec">����&nbsp;</td>
					<td align="middle" bgColor="#c8dfec">�ݾ�</td>
					<td align="middle" bgColor="#c8dfec">����</td>
					<!--
					<td align="middle" bgColor="#c8dfec">����</td>
					-->
<?


//$SQL = "select * from $BonusTable where groupjang ='n' $search_qry $type_qry $con order by num desc";


$SQL = "select * from $BonusTable where length(id) = '12'  $search_qry $type_qry $con order by num desc";


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
	//$write_date = substr($write_date,0,12);
	$bonus = $ary[bonus];
	$content = nl2br($ary[content]);
	$order_num = $ary[order_num];
	
	$bonus_str = number_format($bonus);
	//$sum = $sum + $bonus;
	$j = $numRows - $i;

?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'><?=$j?></td>
					<td align='middle' width='12%' bgColor='#ffffff'><?=$id?></td>
					<td align='middle' width='19%' bgColor='#ffffff'><?=$write_date?></td>
					<td align='middle' width='11%' bgColor='#ffffff'><?=$bonus_str?></td>
					<td width='20%' bgColor='#ffffff' align='center'>
					<?
					if($ary[mode]=="j"){
						echo"������";
					}elseif($ary[mode]=="u"){
						echo"ȸ���Ⱓ����";
					}elseif($ary[mode]=="uc"){
						echo "�з�����[".$content."]";
					}elseif($ary[mode]=="us"){
						echo "$ary[content]";
					}elseif($ary[mode]=="ug"){
						echo "$ary[content]";
					}elseif($ary[mode]=="ji"){
						echo "$ary[content]";
					}elseif($ary[mode]=="gi"){
						echo "$ary[content]";
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
					<a href='bonus_tree.php?pu=$pu&type=$type&username=$rows[item_code]&page=1&searchword=$searchword&searchword2=$searchword2'>ó��</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='bonus_tree.php?pu=$pu&type=$type&username=$rows[item_code]&page=$prev_start_page&searchword=$searchword&searchword2=$searchword2'>
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
					<a href='bonus_tree.php?pu=$pu&type=$type&username=$rows[item_code]&page=$i&searchword=$searchword&searchword2=$searchword2'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='bonus_tree.php?pu=$pu&type=$type&username=$rows[item_code]&page=$next_start_page&searchword=$searchword&searchword2=$searchword2'>
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
					<a href='bonus_tree.php?pu=$pu&type=$type&username=$rows[item_code]&page=$total_page&searchword=$searchword&searchword2=$searchword2'>��</a> 
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



	//�α����� ȸ������
	if($_SESSION["MemberLevel"] == 4){//�Ϲ�ȸ��



	}else if($_SESSION["MemberLevel"] == 10){//�Ѱ�����



			
			$query = "select * from $ItemTable where item_id ='$_SESSION[Mall_Admin_ID]'";
			$result = mysql_query( $query, $dbconn );
			$row = mysql_fetch_array( $result );
		
			
			//�޴»������
			$content = "���翡�� ���� ������";
			$mode = "ug";
			$id = $sea_num.$sung_num.$khan_num.$sudong_num;

			$SQL = "insert into $BonusTable (mart_id, provider_id, id, write_date, bonus, content, mode)  values ('$mart_id', '$provider_id', '$id', '$write_date', '$bonus', '$content', '$mode')";



			$dbresult = mysql_query($SQL, $dbconn);


			//�����������
			$content = $sea_num.$sung_num.$khan_num.$sudong_num."�Բ� ������ ����";
			$mode = "us";
			$id=$_SESSION[Mall_Admin_ID];

			$SQL = "insert into $BonusTable (mart_id, provider_id, bonsa_id, id, write_date, bonus, content, mode) values ('$mart_id', 'admin',  '$provider_id', '$id', '$write_date', '-$bonus', '$content', '$mode')";
			$dbresult = mysql_query($SQL, $dbconn);






	}else{//�׷����
	
	}



			echo("
				<script>
				alert('������ ������ �Ϸ�Ǿ����ϴ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL=bonus_tree.php?username=$username&provider_id=$provider_id&mode=$mode'>
			");
			exit;
	

	
}else if($flag=="del"){
	
	$SQL = "select bonus from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$bonus = mysql_result($dbresult,0,0);
	
	$SQL = "update $Mart_Member_NewTable set bonus_tree = bonus_tree - $bonus 
	where username='$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "delete from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=bonus_tree.php?username=$username&provider_id=$provider_id&mode=$mode'>";
}
?>
<?
mysql_close($dbconn);
?>
