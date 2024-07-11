<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0,user-scalable=yes,target-densitydpi=medium-dpi">

<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">

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
<div class="wrap">
<table border="0" cellpadding="0" cellspacing="0" width="100%" bordercolorlight="#E1E1E1"  align="center">
  <tr>
	 <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td width="100%" height="20" align=center>










		<a href='../../admin/good/job_yongyeok_yochung.php' target='_top'><font size=3><b>[용역지원요청관리]</b></font></a> <a href='../../admin/good/board_frame12.html' target='_top'><font size=3><b>[근무현황]</b></font></a>
				
			
				</td>
			 </tr>
		  </table>
		  </td>
		</tr>
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">



<?php
	$searchword = !$searchword?date("Y"):$searchword;
	$searchword2 = !$searchword2?date("m"):$searchword2;

?>

<form name="frmList" action='<?=$PHP_SELF?>?page=<?=$page?>' method="post">


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="box2">
<input type="hidden" name="page" value="1">
<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
<input type=hidden name="keyset" value="write_date">	
<input type=hidden name="id" value="<?=$id?>">	



 
	<tr>
      <td align=center width=15% class="title">월별검색</td> 
      <td width=35% bgcolor="#FFFFFF">
								<select name='searchword'>	
									<?
									for($i=2019;$i<=date("Y");$i++){
										if($searchword == $i){
											$selected = "selected";
										}
									?>
										<option value="<?=$i?>" <?=$selected?>><?=$i?></option>
									<?
										$selected="";
									}
									?>
								</select>년						
								<select name='searchword2'>	
									<?
									for($z=1;$z<=12;$z++){
										$y = str_pad( $z, 2, "0", STR_PAD_LEFT );
										if($searchword2 == $y){
											$selected = "selected";
										}
									?>

										<option value="<?=$y?>" <?=$selected?>><?=$y?></option>
									<?
											$selected="";
									}
									?>
								</select>월
&nbsp;&nbsp;

								<input type='image' src='../image/bu_search3.gif' hspace='10' border='0' align='absmiddle' onfocus='blur();'> <a href='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>'><img src='../image/bu_cancel2.gif' border='0' align='absmiddle' onfocus='blur();'></a>
			</td>
     
    </tr>

</table>

						

</form>








		 		  <table width="97%" border="0">
			 <tr>
				<td width="100%" bgColor="#999999">
				<table cellSpacing="1" cellPadding="3" width="100%" border="0">
				

				<tr>
					<td align="middle" bgColor="#c8dfec">용역업체</td>
					<td align="middle" bgColor="#c8dfec">구인업체</td>
					<td align="middle" bgColor="#c8dfec">공수</td>					
					<td align="middle" bgColor="#c8dfec">현장지역</td>
					<td align="middle" bgColor="#c8dfec">날짜</td>
				
<?
$now_date = date("Y-m-d");


if($searchword || $searchword2){
	$write_date = $searchword."-".$searchword2;
	$add_query = " and reg_date like '$write_date%' ";
}

//구인업체가 용역업체에 구인요청한 내역
$sql0 = "select * from job_geunro_yo2 where you_id='$_SESSION[Mall_Admin_ID]' $add_query";
$res0 = mysql_query($sql0, $dbconn);

for($i=0;$ary0=mysql_fetch_array($res0);$i++){

	$sql1 = "select * from job_yong_guyo2 where seq_num='$ary0[ori_seq_num]'";
	$res1 = mysql_query($sql1, $dbconn);
	$ary1=mysql_fetch_array($res1);

?>
				<tr>
					<td align='middle'  bgColor='#ffffff'>
					<?
						$que1 = "select item_name from item where item_id='$ary1[you_id]'";
						$que1_res = mysql_query($que1, $dbconn);
						$row = mysql_fetch_array( $que1_res );
						echo $row[item_name];
					?>					
					</td>
					<td align='middle'  bgColor='#ffffff'>
					<?
						$que1 = "select item_name from item where item_id='$ary1[my_id]'";
						$que1_res = mysql_query($que1, $dbconn);
						$row = mysql_fetch_array( $que1_res );
						echo $row[item_name];
					?>
					</td>
					<td align='middle'  bgColor='#ffffff'><?=$ary1[gongsu1]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary1[sido]?> <?=$ary1[gugun]?> <?=$ary1[dong]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary1[reg_date]?></td>
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
//type 구인:1 용역:2 근로자:3

			$query = "select * from $ItemTable where item_id ='$guin_id'";
			$result = mysql_query( $query, $dbconn );
			$row = mysql_fetch_array( $result );
			$num = $row[sea_num].$row[sung_num].$row[khan_num].$row[sudong_num];

			$sql1 = "select * from my_list where my_id='$_SESSION[Mall_Admin_ID]' and id='$guin_id' and num='$num' and type='1'";
			$res1 = mysql_query($sql1,$dbconn);
			$cnt1 = mysql_num_rows($res1);

			if($cnt1 > 0){
				echo("
					<script>
					alert('이미 저장되어 있습니다.');
					</script>
					<meta http-equiv='refresh' content='0; URL=job_guin.php?username=$username&provider_id=$provider_id&mode=$mode'>
				");
				exit;
			}else{			

				$SQL = "insert into my_list (seq_num, my_id, id, num, type)  values ('', '$_SESSION[Mall_Admin_ID]', '$guin_id',  '$num', '1')";
				$dbresult = mysql_query($SQL, $dbconn);
				echo("
					<script>
					alert('저장되었습니다.');
					</script>
					<meta http-equiv='refresh' content='0; URL=job_guin.php?username=$username&provider_id=$provider_id&mode=$mode'>
				");
				exit;
				}





	
}else if($flag=="complete"){
	
	$SQL = "update job_yong_guyo2 set state='2' where seq_num='$seq_num'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=$PHP_SELF'>";
}
?>
<?
mysql_close($dbconn);
?>
