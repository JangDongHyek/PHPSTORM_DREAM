<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">

<?
include "../lib/Mall_Admin_Session.php";
?>
<?

	##################### �α��ν� �������Աݳ��� �ҷ��ͼ� ������ ������ �����ϱ� ���� ##########################
		/*
		$query = "select * from $ItemTable where if_hide='0' and item_id ='$username'";
		$result = mysql_query( $query, $dbconn );
		$row_c = mysql_num_rows( $result );
		$row = mysql_fetch_array( $result );
		
		$all_num = $row[sea_num].$row[sung_num].$row[khan_num].$row[last_num].$row[sudong_num];

		
		
		$SQL1 = "select * from TBLBANK where Bkjukyo='$all_num'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		for($i=0;$row1 = mysql_fetch_array($dbresult1);$i++){
		
				$content = "������"; 
				
				$SQL2 = "select * from $BonusTable where sea_num='$row[sea_num]' and sung_num='$row[sung_num]' and khan_num='$row[khan_num]' and last_num='$row[last_num]' and sudong_num='$row[sudong_num]' and write_date='$row1[Bkxferdatetime]' and content='$row1[Bkcode]' and bonus='$row1[Bkinput]'";
				$dbresult2 = mysql_query($SQL2, $dbconn);
				$rows2_c = mysql_num_rows($dbresult2);
			
				if($rows2_c == 0){

					$SQL3 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode,sea_num,sung_num,khan_num,last_num,sudong_num) values ('$mart_id', '$all_num', '$row1[Bkxferdatetime]', '$row1[Bkinput]', '$row1[Bkcode]', 'j','$row[sea_num]','$row[sung_num]','$row[khan_num]','$row[last_num]','$row[sudong_num]')";
					$dbresult3 = mysql_query($SQL3, $dbconn);
					
					
					$SQL4 = "update $ItemTable set bonus_total = bonus_total + '$row1[Bkinput]' where sea_num='$row[sea_num]' and sung_num='$row[sung_num]' and khan_num='$row[khan_num]' and last_num='$row[last_num]' and sudong_num='$row[sudong_num]'";
					$dbresult4 = mysql_query($SQL4, $dbconn);
					
				}

		}
		*/

	//�����ϱ�
		$SQL1 = "SELECT * FROM `TBLBANK` WHERE Bkjukyo REGEXP '[0-9]'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		for($i=0;$row1 = mysql_fetch_array($dbresult1);$i++){
		
	

				if($row1[Bkinput] > 0){


					$item_id1 = substr($row1[Bkjukyo],0,3);
					$item_id2 = substr($row1[Bkjukyo],3,2);
					$item_id3 = substr($row1[Bkjukyo],5,2);
					$item_id4 = substr($row1[Bkjukyo],7,4);





					if($item_id1 && $item_id2 && $item_id3 && $item_id4){
						$sql2 = "select * from item where sea_num='$item_id1' and sung_num='$item_id2' and khan_num='$item_id3' and sudong_num='$item_id4'";
					}elseif($item_id1 && $item_id2 && $item_id3){
						$sql2 = "select * from category where sea_num='$item_id1' and sung_num='$item_id2' and khan_num='$item_id3'  and category_degree='2'";
					}elseif($item_id1 && $item_id2){
						$sql2 = "select * from category where sea_num='$item_id1' and sung_num='$item_id2'  and category_degree='1'";
					}elseif($item_id1){
						$sql2 = "select * from category where sea_num='$item_id1' and category_degree='0'";
					}


					$res2 = mysql_query($sql2,$dbconn);
					$cnt2 = mysql_num_rows($res2);
		
					if($cnt2 > 0){
						

					
							$content = "������"; 
							
							$SQL2 = "select * from $BonusTable where id='$row1[Bkjukyo]' and write_date='$row1[Bkxferdatetime]' and content='$row1[Bkcode]' and bonus='$row1[Bkinput]'";
							$dbresult2 = mysql_query($SQL2, $dbconn);
							$rows2_c = mysql_num_rows($dbresult2);
						
							if($rows2_c == 0){

								$SQL3 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode,sea_num,sung_num,khan_num,sudong_num) values ('$mart_id', '$row1[Bkjukyo]', '$row1[Bkxferdatetime]', '$row1[Bkinput]', '$row1[Bkcode]', 'j','$item_id1','$item_id2','$item_id3','$item_id4','$item_id5')";
								$dbresult3 = mysql_query($SQL3, $dbconn);
								
								if($item_id1 && $item_id2 && $item_id3 && $item_id4 && $item_id5){
									$SQL4 = "update $ItemTable set bonus_total = bonus_total + '$row1[Bkinput]' where sea_num='$item_id1' and sung_num='$row[sung_num]' and khan_num='$row[khan_num]'  and sudong_num='$row[sudong_num]'";
									$dbresult4 = mysql_query($SQL4, $dbconn);
								}else{

								}
							}
					
					
					
					
					
					}


					
				}
		}


	##################### �α��ν� �������Աݳ��� �ҷ��ͼ� ������ ������ �����ϱ� �� ##########################









	//ȯ���ϱ�
		$SQL1 = "SELECT * FROM `TBLBANK` WHERE Bkjukyo REGEXP '[0-9]' and hwanjun='n'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		for($i=0;$row1 = mysql_fetch_array($dbresult1);$i++){
		
	

				if($row1[Bkoutput] > 0){


					$item_id1 = substr($row1[Bkjukyo],0,3);
					$item_id2 = substr($row1[Bkjukyo],3,2);
					$item_id3 = substr($row1[Bkjukyo],5,2);
					$item_id4 = substr($row1[Bkjukyo],7,4);

					if($item_id1 && $item_id2 && $item_id3 && $item_id4 && $item_id5){
						$sql2 = "select * from item where sea_num='$item_id1' and sung_num='$item_id2' and khan_num='$item_id3' and sudong_num='$item_id4'";
					}elseif($item_id1 && $item_id2 && $item_id3){
						$sql2 = "select * from category where sea_num='$item_id1' and sung_num='$item_id2' and khan_num='$item_id3'  and category_degree='2'";
					}elseif($item_id1 && $item_id2){
						$sql2 = "select * from category where sea_num='$item_id1' and sung_num='$item_id2'  and category_degree='1'";
					}elseif($item_id1){
						$sql2 = "select * from category where sea_num='$item_id1' and category_degree='0'";
					}


					$res2 = mysql_query($sql2,$dbconn);
					$cnt2 = mysql_num_rows($res2);
		
					if($cnt2 > 0){
						
							$sql3 = "update bonus set hwanjun='y' where hwanjun='n' and mode='us' and id='$row1[Bkjukyo]'";
							$res3 = mysql_query($sql3, $dbconn);

							$sql4 = "update TBLBANK set hwanjun='y' where Bkid='$row1[Bkid]'";
							$res4 = mysql_query($sql4, $dbconn);
					}


					
				}
		}










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
<div class="wrap">
<table border="0" cellpadding="0" cellspacing="0" width="98%" bordercolorlight="#E1E1E1"  align="center">
  <tr>
	 <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td width="100%" height="20">


<form name="frmList" action='<?=$PHP_SELF?>?page=<?=$page?>' method="post">


<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="box2">
<input type="hidden" name="page" value="1">
<input type="hidden" name="type" value="<?=$type?>">



 
	<tr>
      <td align=center width=15% class="title">�����˻�</td> 
      <td width=45% bgcolor="#FFFFFF">
								<select name='searchword'>	
									<?
									for($i=2017;$i<=date("Y");$i++){
										if($i==$searchword){
											$seled1="selected";
										
										}
			
									?>
										<option value="<?=$i?>" <?=$seled1?>><?=$i?></option>
									<?
										$seled1="";
									}
									?>
								</select>��						
								<select name='searchword2'>	
									<?
									for($z=1;$z<=12;$z++){
										if($z==$searchword2){
											$seled2="selected";
										
										}
										$y = str_pad( $z, 2, "0", STR_PAD_LEFT );
									?>
										<option value="<?=$y?>" <?=$seled2?>><?=$y?></option>
									<?
										$seled2="";
									}
									?>
								</select>��
&nbsp;&nbsp;<input type=checkbox name="hwanjun_miss" value="y">��ȯ���˻�&nbsp;&nbsp;

								<input type='image' src='../image/bu_search3.gif' hspace='10' border='0' align='absmiddle' onfocus='blur();'> <a href='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>'><img src='../image/bu_cancel2.gif' border='0' align='absmiddle' onfocus='blur();'></a>
			</td>
     
    </tr>

</table>

						

</form>











<?

if($hwanjun == 'y'){
	$hwanjun_date = date("YmdHis");
	$sql = "update bonus set hwanjun='y', hwanjun_date='$hwanjun_date' where num='$num'";
	$res = mysql_query($sql,$dbconn);
}



if($searchword && $searchword2){
	$search_qry = "and binary write_date like '$searchword$searchword2%'";
}

$sql = "select sum(bonus) as bonus_total from bonus where mode='us' and hwanjun='y'";
$res = mysql_query($sql, $dbconn);
$rows = mysql_fetch_array($res);
$hwantot = $rows[bonus_total];



$sum_sql = "select sum(bonus) as bonus_total from $BonusTable where bonus > '0' and mart_id ='$mart_id' $search_qry and mode='j'";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_total_str1 = $sum_rows[bonus_total];

$bonus_total_str11 = $bonus_total_str1 - abs($hwantot);


//���������Ʈ(ȸ�簡 �׷������� ������ ����)
$sum_sql = "select sum(bonus) as bonus_total from $BonusTable where bonus < '0' and groupjang ='n' $search_qry";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_total_str2 = $sum_rows[bonus_total];

//��������Ʈ�� ȸ�簡 �׷������� ���� ����Ʈ ���ؾ���
$sum_sql = "select sum(bonus) as bonus_total from $BonusTable where bonus > '0' and groupjang ='y' $search_qry";
$sum_rs = mysql_query($sum_sql, $dbconn);
$sum_rows = mysql_fetch_array($sum_rs);
$bonus_total_str4 = $sum_rows[bonus_total];

		
	



$bonus_total_str2 = abs($bonus_total_str2) - abs($bonus_total_str4);



$bonus_total_str = $bonus_total_str1 - $bonus_total_str2;

if($type == "h"){//ȯ����û�� �������� - ȯ����û�ݾ� �ؼ� �����ֱ�
	$sql = "select sum(bonus) as bonus_total from bonus where bonus > '0' and mart_id ='khj' and (mode='us' or mode='ug' or mode='j')";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);
	$tot1 = $rows[bonus_total];

	$sql = "select sum(bonus) as bonus_total from bonus where bonus < '0' and mart_id ='khj' and (mode='us' or mode='ug' or mode='j')";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);
	$tot2 = $rows[bonus_total];

	$sql = "select sum(bonus) as bonus_total from bonus where mode='us' and hwanjun='y'";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);
	$tot3 = $rows[bonus_total];
	



	$bonus_total_str = $tot1+$tot2+$tot3;
	
}
	$bonus_total_str3 = $bonus_total_str11 - $bonus_total_str2;

	$bonus_total_str3 = abs($bonus_total_str3) - abs($hwantot);

	//ȸ�簡 �׷������� ����Ʈ�ָ� ����� ����Ʈ���� �����⶧���� (������Ʈ-���������Ʈ�ϸ� ��������Ʈ�� ������.....)
	$bonus_total_str3 = ($bonus_total_str4 * 2) + $bonus_total_str3;

?>
				<p align="center"><b>[ȸ�� �����ݳ���] </b> &nbsp; <a href="./bonus_my.php"><b>[������Ʈ����] </b></a><br>
				<br>

				���� : <!--<a href="./bonus_total.php?type=c&searchword=<?=$searchword?>&searchword2=<?=$searchword2?>"><b>[������]</b></a>-->&nbsp;<a href="./bonus_total.php?type=j&searchword=<?=$searchword?>&searchword2=<?=$searchword2?>"><b>[�������]</b></a>&nbsp;<a href="./bonus_total.php?type=g&searchword=<?=$searchword?>&searchword2=<?=$searchword2?>"><b>[������]</b></a>&nbsp;<a href="./bonus_total.php?type=m&searchword=<?=$searchword?>&searchword2=<?=$searchword2?>"><b>[ȸ���Ⱓ����]</b></a>&nbsp;<a href="./bonus_total.php?type=h&searchword=<?=$searchword?>&searchword2=<?=$searchword2?>"><b>[ȯ����û]</b></a>

				<BR>
				<!--�� ������ : <?=number_format($bonus_total_str1);?>�� &nbsp; ����������� : <?=number_format($bonus_total_str2);?>�� =--> 
				
				<!--<b>�հ� : <?=number_format($bonus_total_str);?>��</b>--> 
				
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="box2">
				<tr>
					<td align="middle" bgColor="#c8dfec">������Ʈ</td>
					<td align="middle" bgColor="#c8dfec">���������Ʈ</td>
					<td align="middle" bgColor="#c8dfec">��������Ʈ</td>
					<td align="middle" bgColor="#c8dfec">ȯ���Ϸ�����Ʈ</td>
				</tr>
				<tr>
					<td align='middle' bgColor='#ffffff'><?=number_format($bonus_total_str11);?></td>
					<td align='middle' bgColor='#ffffff'>-<?=number_format($bonus_total_str2);?></td>
					<td align='middle' bgColor='#ffffff'><?=number_format($bonus_total_str3);?></td>
					<td align='middle' bgColor='#ffffff'><?=abs(number_format($hwantot));?></td>
				</tr>
</table>











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
				<form action='bonus_total.php' method='post' onsubmit="return frm_val(this)">
				<input type='hidden' name='flag' value='add'>
				<input type='hidden' name='username' value='<?=$username?>'>
				<input type='hidden' name='provider_id' value='<?=$Mall_Admin_ID?>'>
				<input type='hidden' name='mode' value='<?=$mode?>'>

				<tr>
					<td align="left" width="12%" bgColor="#c8dfec">ȸ����ȣ</td>
						<?
					if($type=="h"){
				?>
					<td align="left" width="88%" bgColor="#ffffff" colSpan="8">
					<?}else{?>
					<td align="left" width="88%" bgColor="#ffffff" colSpan="5">

					<?}?>
					<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="5" maxlength=3>
					-
					<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2>
					-
					<input class="aa" type="text" name="khan_num" value='<?=$khan_num?>' size="3" maxlength=2>
					
					-
					<input class="aa" type="text" name="sudong_num" value='<?=$sudong_num?>' size="5" maxlength=4>
					
				</td>
				</tr>

				<tr>
					<td align="left" width="12%" bgColor="#c8dfec">����������</td>

						<?
					if($type=="h"){
				?>
					<td align="left" width="88%" bgColor="#ffffff" colSpan="8">				
					<?}else{?>
					<td align="left" width="88%" bgColor="#ffffff" colSpan="5">				

					<?}?>

							
						<input name="bonus" class="input_03" size="15"> 
						<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value=" �� �� ">
					</td>
				</tr>
				</form>
				
				<tr>
					<td align="middle" bgColor="#c8dfec">No.</td>
					<td align="middle" bgColor="#c8dfec">ȸ����ȣ</td>
					<td align="middle" bgColor="#c8dfec">����&nbsp;</td>
					<td align="middle" bgColor="#c8dfec">�ݾ�</td>
					<?
					if($type=="h"){
				?>
				<td align="middle" bgColor="#c8dfec">�����</td>
				<td align="middle" bgColor="#c8dfec">���¹�ȣ</td>
				<td align="middle" bgColor="#c8dfec">������</td>
				<?}?>

					<td align="middle" bgColor="#c8dfec">����</td>
					<!--
					<td align="middle" bgColor="#c8dfec">����</td>
					-->
<?



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


if($hwanjun_miss == 'y'){
	$type_qry = "";
	$search_qry = "";
	$hwanmisqry = " and hwanjun='n' and mode='us' ";
}

$SQL = "select * from $BonusTable where mart_id ='$mart_id' $search_qry $type_qry $hwanmisqry order by num desc";

//echo $SQL;

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
					<td align='middle' width='12%' bgColor='#ffffff'><a href="#" onclick="javascript:window.open('../account.html?item_id=<?=$id?>','','width=444,height=264,left=300,top=200');"><?=$id?></a></td>
					<td align='middle' width='19%' bgColor='#ffffff'><?=$write_date?></td>
					<td align='middle' width='11%' bgColor='#ffffff'><?=$bonus_str?></td>

					<?
					if($type=="h"){

					$item_id1 = substr($id,0,3);
					$item_id2 = substr($id,3,2);
					$item_id3 = substr($id,5,2);
					$item_id4 = substr($id,7,4);


					$query2 = "select * from $ItemTable where sea_num='$item_id1' and sung_num ='$item_id2' and khan_num='$item_id3' and sudong_num='$item_id4'";
					$result2 = mysql_query( $query2, $dbconn );
					$row2 = mysql_fetch_array( $result2 );




				?>
					<td align='middle'  bgColor='#ffffff'><?=$row2[my_bank_name]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$row2[my_bank_account]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$row2[my_bank_master]?></td>
				<?}?>



					<td width='20%' bgColor='#ffffff' align='center'>
					<?
					if($ary[mode]=="j"){
						echo"������";
					}elseif($ary[mode]=="u"){
						echo"ȸ���Ⱓ����";
					}elseif($ary[mode]=="uc"){
						echo "�з�����[".$content."]";
					}elseif($ary[mode]=="us"){
					?>
						<?if($ary[hwanjun] != y){?>
						<?=$ary[content]?><font color="blue"><b>[ȯ�����]</b></font>
						<?}else{?>
							<?=$ary[content]?><font color="green"><b>[ȯ���Ϸ�]</b></font>
						<?}?>
					<?
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
					<a href='bonus_total.php?type=$type&username=$rows[item_code]&page=1&searchword=$searchword&searchword2=$searchword2'>ó��</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='bonus_total.php?type=$type&username=$rows[item_code]&page=$prev_start_page&searchword=$searchword&searchword2=$searchword2'>
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
					<a href='bonus_total.php?type=$type&username=$rows[item_code]&page=$i&searchword=$searchword&searchword2=$searchword2'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='bonus_total.php?type=$type&username=$rows[item_code]&page=$next_start_page&searchword=$searchword&searchword2=$searchword2'>
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
					<a href='bonus_total.php?type=$type&username=$rows[item_code]&page=$total_page&searchword=$searchword&searchword2=$searchword2'>��</a> 
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
</div>
</body>
</html>
<?
}else if($flag=="add"){
	$write_date = date("YmdHis");



	//�α����� ȸ������
	if($_SESSION["MemberLevel"] == 4){//�Ϲ�ȸ��



	}else if($_SESSION["MemberLevel"] == 10){//�Ѱ�����


			


			if($sudong_num){			
				$groupjang='n';
			}else{
				$groupjang='y';
			}
			
			//�޴»������
			$content = "���翡�� ���� ������";
			$mode = "ug";
			
			$id = $sea_num.$sung_num.$khan_num.$sudong_num;

			$SQL = "insert into $BonusTable (mart_id, provider_id, groupjang, id, write_date, bonus, content, mode)  values ('$mart_id', '$provider_id', '$groupjang', '$id', '$write_date', '$bonus', '$content', '$mode')";



			$dbresult = mysql_query($SQL, $dbconn);


			//�����������
			$content = $sea_num.$sung_num.$khan_num.$sudong_num."�Բ� ������ ����";
			$mode = "ug";
			$id=$_SESSION[Mall_Admin_ID];

			$SQL = "insert into $BonusTable (mart_id, provider_id, bonsa_id, groupjang, id, write_date, bonus, content, mode) values ('$mart_id', 'admin',  '$provider_id', '$groupjang','$id', '$write_date', '-$bonus', '$content', '$mode')";
			$dbresult = mysql_query($SQL, $dbconn);






	}else{//�׷����
	
	}



			echo("
				<script>
				alert('������ ������ �Ϸ�Ǿ����ϴ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL=bonus_total.php?username=$username&provider_id=$provider_id&mode=$mode'>
			");
			exit;
	

	
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
