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
 <form name=f method=post action="<?=$PHP_SELF?>">
<input type=hidden name="seq_num" value="<?=$seq_num?>">
<input type=hidden name="flag" value="add">
 <tr>
	 <td vAlign="top" width="646" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td width="100%" height="20" align=center>











					<a href="../../admin/good/board_frame12.html">[관리화면처음으로가기]</a>

<BR>
				<p align="center"><b>[용역업체 지원받음] </b><br>
				
			
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
					<td align="middle" bgColor="#c8dfec">종목</td>
					<td align="middle" bgColor="#c8dfec">인원수</td>					
					<td align="middle" bgColor="#c8dfec">지역</td>
					<td align="middle" bgColor="#c8dfec">공수</td>
					<td align="middle" bgColor="#c8dfec">금액</td>
					<td align="middle" bgColor="#c8dfec">서명</td>
				
<?

$now_date = date("Y-m-d");


//if($search_category_num){
//	$add_query = " and guenroja_type='$search_category_num' ";
//}

//구인업체가 용역업체에 구인요청한 내역
$SQL = "select * from job_yong_guyo where seq_num='$seq_num'";




$dbresult = mysql_query($SQL, $dbconn);

$ary=mysql_fetch_array($dbresult);
$settle1_chk = $ary[settle1];
	//jongmok1, inwon1, jiyeok1

	if($ary[inwon1] && $ary[sido]){
?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>1</td>
					<td align='middle'  bgColor='#ffffff'>
					<?
						$SQL = "select category_name from job_jongmok where category_num='$ary[jongmok1]'";
						$dbresult = mysql_query($SQL, $dbconn);
						$row = mysql_fetch_array( $dbresult );
						echo $row[category_name];
					?>
					</td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[inwon1]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[sido]?> <?=$ary[gugun]?> <?=$ary[dong]?></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="gongsu1" value="<?=$ary[gongsu1]?>" size=4></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="money1" value="<?=$ary[money1]?>" size=10></td>
					<td align='middle'  bgColor='#ffffff'><input type=checkbox name="settle1" value="y" <?if($ary[settle1]=='y'){echo"checked";}?>></td>
				</tr>
				<tr>
					<td colspan=7 bgColor='#ffffff'>
						<table>
							<tR>
								<td bgColor='#ffffff'>
								<?
								$sql11 = "select * from job_geunro_yo where category_num = '$ary[jongmok1]' ";
								$res11 = mysql_query($sql11);		
								for($i=0;$ary11=mysql_fetch_array($res11);$i++){
									$SQL = "select * from item where item_id='$ary11[you_id]'";
									$dbresult = mysql_query($SQL, $dbconn);
									$ary22=mysql_fetch_array($dbresult);
									if($ary11[auth_yn] == "n"){
										$stat = "[대기]";
									}elseif($ary11[auth_yn] == "y"){
										$stat = "[승낙]";
									}else{
										$stat = "[거절]";
									}
								?>
										<?=$ary22[item_name]?><?=$stat?>
										
								<?
								}
								?>
								</td>
							</tr>
						</table>
					</tD>
				</tr>
<?
	}
?>
<?
	if($ary[inwon2] && $ary[sido2]){
?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>1</td>
					<td align='middle'  bgColor='#ffffff'>
					<?
						$SQL = "select category_name from job_jongmok where category_num='$ary[jongmok2]'";
						$dbresult = mysql_query($SQL, $dbconn);
						$row = mysql_fetch_array( $dbresult );
						echo $row[category_name];
					?>
					</td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[inwon2]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[sido2]?> <?=$ary[gugun2]?> <?=$ary[dong2]?></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="gongsu2" value="<?=$ary[gongsu2]?>" size=4></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="money2" value="<?=$ary[money2]?>" size=10></td>
					<td align='middle'  bgColor='#ffffff'><input type=checkbox name="settle2" value="y" <?if($ary[settle2]=='y'){echo"checked";}?>></td>
				</tr>
				<tr>
					<td colspan=7 bgColor='#ffffff'>
						<table>
							<tR>
								<td bgColor='#ffffff'>
								<?
								$sql11 = "select * from job_geunro_yo where category_num = '$ary[jongmok2]' ";
								$res11 = mysql_query($sql11);		
								for($i=0;$ary11=mysql_fetch_array($res11);$i++){
									$SQL = "select * from item where item_id='$ary11[you_id]'";
									$dbresult = mysql_query($SQL, $dbconn);
									$ary22=mysql_fetch_array($dbresult);
									if($ary11[auth_yn] == "n"){
										$stat = "[대기]";
									}elseif($ary11[auth_yn] == "y"){
										$stat = "[승낙]";
									}else{
										$stat = "[거절]";
									}
								?>							
										<?=$ary22[item_name]?><?=$stat?>
										
								<?
								}
								?>
								</td>
							</tr>
						</table>
					</tD>
				</tr>
<?
	}
?>
<?
	if($ary[inwon3] && $ary[sido3]){
?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>1</td>
					<td align='middle'  bgColor='#ffffff'>
					<?
						$SQL = "select category_name from job_jongmok where category_num='$ary[jongmok3]'";
						$dbresult = mysql_query($SQL, $dbconn);
						$row = mysql_fetch_array( $dbresult );
						echo $row[category_name];
					?>
					</td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[inwon3]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[sido3]?> <?=$ary[gugun3]?> <?=$ary[dong3]?></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="gongsu3" value="<?=$ary[gongsu3]?>" size=4></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="money3" value="<?=$ary[money3]?>" size=10></td>
					<td align='middle'  bgColor='#ffffff'><input type=checkbox name="settle3" value="y" <?if($ary[settle3]=='y'){echo"checked";}?>></td>
				</tr>
				<tr>
					<td colspan=7 bgColor='#ffffff'>
						<table>
							<tR>
								<td bgColor='#ffffff'>
								<?
								$sql11 = "select * from job_geunro_yo where category_num = '$ary[jongmok3]' ";
								$res11 = mysql_query($sql11);		
								for($i=0;$ary11=mysql_fetch_array($res11);$i++){
									$SQL = "select * from item where item_id='$ary11[you_id]'";
									$dbresult = mysql_query($SQL, $dbconn);
									$ary22=mysql_fetch_array($dbresult);
									if($ary11[auth_yn] == "n"){
										$stat = "[대기]";
									}elseif($ary11[auth_yn] == "y"){
										$stat = "[승낙]";
									}else{
										$stat = "[거절]";
									}
								?>
										<?=$ary22[item_name]?><?=$stat?>
										
								<?
								}
								?>
								</td>
							</tr>
						</table>
					</tD>
				</tr>
<?
	}
?>
<?
	if($ary[inwon4] && $ary[sido4]){
?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>1</td>
					<td align='middle'  bgColor='#ffffff'>
					<?
						$SQL = "select category_name from job_jongmok where category_num='$ary[jongmok4]'";
						$dbresult = mysql_query($SQL, $dbconn);
						$row = mysql_fetch_array( $dbresult );
						echo $row[category_name];
					?>
					</td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[inwon4]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[sido4]?> <?=$ary[gugun4]?> <?=$ary[dong4]?></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="gongsu4" value="<?=$ary[gongsu4]?>" size=4></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="money4" value="<?=$ary[money4]?>" size=10></td>
					<td align='middle'  bgColor='#ffffff'><input type=checkbox name="settle4" value="y" <?if($ary[settle4]=='y'){echo"checked";}?>></td>
				</tr>
				<tr>
					<td colspan=7 bgColor='#ffffff'>
						<table>
							<tR>
								<td bgColor='#ffffff'>
								<?
								$sql11 = "select * from job_geunro_yo where category_num = '$ary[jongmok4]' ";
								$res11 = mysql_query($sql11);		
								for($i=0;$ary11=mysql_fetch_array($res11);$i++){
									$SQL = "select * from item where item_id='$ary11[you_id]'";
									$dbresult = mysql_query($SQL, $dbconn);
									$ary22=mysql_fetch_array($dbresult);
									if($ary11[auth_yn] == "n"){
										$stat = "[대기]";
									}elseif($ary11[auth_yn] == "y"){
										$stat = "[승낙]";
									}else{
										$stat = "[거절]";
									}
								?>
										<?=$ary22[item_name]?><?=$stat?>
										
								<?
								}
								?>
								</td>
							</tr>
						</table>
					</tD>
				</tr>
<?
	}
?>
<?
	if($ary[inwon5] && $ary[sido5]){
?>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>1</td>
					<td align='middle'  bgColor='#ffffff'>
					<?
						$SQL = "select category_name from job_jongmok where category_num='$ary[jongmok5]'";
						$dbresult = mysql_query($SQL, $dbconn);
						$row = mysql_fetch_array( $dbresult );
						echo $row[category_name];
					?>
					</td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[inwon5]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[sido5]?> <?=$ary[gugun5]?> <?=$ary[dong5]?></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="gongsu5" value="<?=$ary[gongsu5]?>" size=4></td>
					<td align='middle'  bgColor='#ffffff'><input type=text name="money5" value="<?=$ary[money5]?>" size=10></td>
					<td align='middle'  bgColor='#ffffff'><input type=checkbox name="settle5" value="y" <?if($ary[settle5]=='y'){echo"checked";}?>></td>
				</tr>
				<tr>
					<td colspan=7 bgColor='#ffffff'>
						<table>
							<tR>
								<td bgColor='#ffffff'>
								<?
								$sql11 = "select * from job_geunro_yo where category_num = '$ary[jongmok5]' ";
								$res11 = mysql_query($sql11);		
								for($i=0;$ary11=mysql_fetch_array($res11);$i++){
									$SQL = "select * from item where item_id='$ary11[you_id]'";
									$dbresult = mysql_query($SQL, $dbconn);
									$ary22=mysql_fetch_array($dbresult);
									if($ary11[auth_yn] == "n"){
										$stat = "[대기]";
									}elseif($ary11[auth_yn] == "y"){
										$stat = "[승낙]";
									}else{
										$stat = "[거절]";
									}
								?>
										<?=$ary22[item_name]?><?=$stat?>
										
								<?
								}
								?>
								</td>
							</tr>
						</table>
					</tD>
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
		  <td vAlign="top" width="100%" bgColor="#ffffff">
			<?
				if($settle1_chk == 'y'){
			?>
			[거래완료]
			<?}else{?>
			<input type=submit value="결제완료하기">
			<?}?>
		  </td>
		</tr>
	 </table>
	 </td>
  </tr>
  </form>
</table>





</body>
</html>
<?
}else if($flag=="add"){
	$write_date = date("YmdHis");
//type 구인:1 용역:2 근로자:3

				//state 1:요청중 2:지원받음 3:거래완료

			$sql = "update job_yong_guyo set  gongsu1='$gongsu1',money1='$money1',settle1='$settle1',gongsu2='$gongsu2',money2='$money2',settle2='$settle2',gongsu3='$gongsu3',money3='$money3',settle3='$settle3',gongsu4='$gongsu4',money4='$money4',settle4='$settle4',gongsu5='$gongsu5',money5='$money5',settle5='$settle5' where seq_num='$seq_num'";
			$dbresult = mysql_query($sql, $dbconn);

		if($settle1 == "y"){
			$sql = "update job_yong_guyo set  state='3' where seq_num='$seq_num'";
			$dbresult = mysql_query($sql, $dbconn);

		
			$sql2="insert into job_yong_guyo2 ( select * from job_yong_guyo where seq_num='$seq_num')";
			$dbresult2 = mysql_query($sql2, $dbconn);

			$sql3="insert into job_geunro_yo2 ( select * from job_geunro_yo where ori_seq_num='$seq_num')";
			$dbresult3 = mysql_query($sql3, $dbconn);

			$sql4="delete from job_yong_guyo where seq_num='$seq_num'";
			$dbresult4 = mysql_query($sql4, $dbconn);

			$sql5="delete from job_geunro_yo where ori_seq_num='$seq_num'";
			$dbresult5 = mysql_query($sql5, $dbconn);
		
			echo("
				<script>
				alert('요청완료.');
				</script>
				<meta http-equiv='refresh' content='0; URL=job_yongyeok.php?seq_num=$seq_num'>
			");
			exit;
		}

			echo("
				<script>
				alert('요청완료.');
				</script>
				<meta http-equiv='refresh' content='0; URL=job_gongsu.php?seq_num=$seq_num'>
			");
			exit;





	
}else if($flag=="complete"){
	
	$SQL = "update job_yong_guyo set state='2' where seq_num='$seq_num'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=$PHP_SELF'>";
}
?>
<?
mysql_close($dbconn);
?>
