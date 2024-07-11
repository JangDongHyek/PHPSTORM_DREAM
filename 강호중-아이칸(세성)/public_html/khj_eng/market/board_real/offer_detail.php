<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 설정 파일을 불러옴 =============================================
include "../../main.class";
?><?

$sql = "select * from offer where seq_num = '$seq_num'";
$res  = mysql_query($sql,$dbconn);
$rows = mysql_fetch_array($res);


$sql2 = "select * from item where item_id='$rows[item_no]'";
$result2 = mysql_query($sql2,$dbconn);
$rows2 = mysql_fetch_array($result2);

?>
<html>
<head>
<title>구매 및 신청요청 상세보기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm){
	if(frm.content.value==""){
		alert("\n내용을 입력하세요.");
		frm.content.focus();
		return false;
	}	
	return true;
}

</script>



</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="390" height="100%"  border="0" cellpadding="0" cellspacing="0" align=center>
	<tr valign="top">
		<td>


			<!--내용 START~~-->  	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px"><b>[상세보기]</b><br><br>
				</td>
			</tr>
			<!--
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px">※제목,내용,게시기간 항목에 대해서만 수정요청이 가능합니다.<br><br>
				</td>
			</tr>
			-->
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF"></td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
        		<table border="0" width="95%">
          		<form action='offer_detail.php' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="flag" value="add">
  				<input type="hidden" name="seq_num" value="<?=$seq_num?>">
     		<tr>
            		<td width="90%" bgcolor="#999999">
    
					<table border="0" width="100%" cellpadding=1 cellspacing=1>
                		<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>작성시간</b>  &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows[regdate]?>
                			</td>
						</tr>
                		<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>이름</b>    &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[item_name]?>
                			</td>
						</tr>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>핸드폰</b>  &nbsp;  
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[mobile]?>
                			</td>
						</tr>
						<?
						if($rows[open_tel] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>전화번호</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[tel]?>
                			</td>
              			</tr>
						<?}?>
						<?
						if($rows[open_address] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>주소</b>  &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[address]?> <font style='cursor:hand;' onclick="window.open('./map.php?address_pop=<?=$rows2[address]?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[위치확인]</font>	
                			</td>
              			</tr>
 						<?}?>
						<?
						if($rows[open_email] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>이메일</b>  &nbsp; 
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								 &nbsp;<?=$rows2[email]?>
                			</td>
              			</tr>
						<?}?>
						<?
						if($rows[open_hobby] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>취미</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$rows2[hobby]?>
                			</td>
              			</tr>
						<?}?>
 						<?
						if($rows[open_num] == 'y'){
						?>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>회원번호</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<?=$row2[country_num]?><?=$row2[sea_num]?><?=$row2[sung_num]?><?=$row2[khan_num]?><?=$row2[sudong_num]?>
                			</td>
              			</tr>
						<?}?>

						<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="2">
                				<b>문의사항</b>  &nbsp;
							</td>
              			</tr>
              			<tr>
                			<td width="100%" height=200 bgcolor="#FFFFFF" colspan="2" valign=top>
								<?=nl2br($rows[content])?>
                			</td>
              			</tr>
					</table>
<?
//자기글일때 수정요청,삭제요청	
if($username == $_SESSION[Mall_Admin_ID]){
?>
<table border="0" width="100%" cellpadding=1 cellspacing=1>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>완료여부</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<input type=radio name=state value="y" <?if($rows[state]=='y'){echo"checked";}?>>완료 <input type=radio name=state value="n" <?if($rows[state]=='n'){echo"checked";}?>>미완료
                			</td>
              			</tr>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>미수금여부</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<input type=radio name=misu value="y" <?if($rows[misu]=='y'){echo"checked";}?>>예 <input type=radio name=misu value="n" <?if($rows[misu]=='n'){echo"checked";}?>>아니요
                			</td>
              			</tr>
						<tr>
                			<td width="30%" bgcolor="#FFFFFF" align=right>
								<b>기타메모</b>   &nbsp;
                			</td>
                			<td width="70%" bgcolor="#FFFFFF" >
								&nbsp;<textarea name="memo" rows='13' cols='30'><?=$rows[memo]?></textarea>
                			</td>
              			</tr>

		
		</table>
<?}?>




            		</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center"><br>
				
        	<input type=submit style='width:60' type="submit" value=" 수정 " style='cursor:hand'>&nbsp;&nbsp;	<input  onclick="javascript:window.close();" class='butt_none' style='width:60' type="button" style='cursor:hand' value="창닫기">
        	</td>
      	</tr>
  
		</form>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
if($flag=="add"){
	
	$regdate = date("Y-m-d H:i:s");
	//회원기간도 추출해서 insert하기
	$sql = "update offer set state='$state', misu='$misu', memo='$memo' where seq_num='$seq_num'";


	$res = mysql_query($sql,$dbconn);


	echo "
		<script>
			alert('수정 하였습니다.');opener.location.reload();window.close();
		</script>
	";
	exit;
}
?>
