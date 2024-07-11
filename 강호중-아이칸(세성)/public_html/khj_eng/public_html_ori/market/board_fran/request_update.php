<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 설정 파일을 불러옴 =============================================
include "../../main.class";
?><?

if($flag!="add"){

	$sql  = "select * from new_board where bbs_no='$bbs_no' and index_no='$index_no'";
	$res  = mysql_query($sql,$dbconn);
	$rows = mysql_fetch_array($res);

	$firstno = $rows[firstno];
	$prevno = $rows[prevno];
	$thirdno = $rows[thirdno];
	$category_num = $rows[category_num];
}
?>
<html>
<head>
<title>수정요청</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm){
	if(frm.content.value==""){
		alert("\n요청내용을 입력하세요.");
		frm.content.focus();
		return false;
	}	
	return true;
}

</script>



</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="410" height="100%"  border="0" cellpadding="0" cellspacing="0" align=center>
	<tr valign="top">
		<td>


			<!--내용 START~~-->  	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px"><b>[수정요청]</b><br><br>
				</td>
			</tr>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px">※게시기간 항목에 대해서만 수정요청이 가능합니다.<br><br>
				</td>
			</tr>
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
          		<form action='request_update.php' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="flag" value="add">
				<input type="hidden" name="pu" value="<?=$pu?>">
				<input type="hidden" name="firstno" value="<?=$firstno?>">
				<input type="hidden" name="prevno" value="<?=$prevno?>">
				<input type="hidden" name="thirdno" value="<?=$thirdno?>">
				<input type="hidden" name="category_num" value="<?=$category_num?>">
  				<input type="hidden" name="item_no" value="<?=$_SESSION[Mall_Admin_ID]?>">
     			<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
     			<input type="hidden" name="index_no" value="<?=$index_no?>">
     		<tr>
            		<td width="90%" bgcolor="#999999">
    
					<table border="0" width="100%" cellpadding=1 cellspacing=1>

              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				게시기간 연장							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="6">
								<input type=radio name="content" value="5일" checked>5일
								<input type=radio name="content" value="10일">10일
								<input type=radio name="content" value="20일">20일
								<input type=radio name="content" value="1개월">1개월
								<input type=radio name="content" value="3개월">3개월
								<input type=radio name="content" value="6개월">6개월
								<input type=radio name="content" value="12개월">12개월
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center"><br>
				<input type=submit style='width:60' type="submit" value="요청하기" style='cursor:hand'>&nbsp;&nbsp;
        		<input  onclick="javascript:window.close();" class='butt_none' style='width:60' type="button" style='cursor:hand' value="창닫기">
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
	$sql = "insert into request_update_fran (seq_num,firstno,prevno,thirdno,category_num,item_no,content,update_yn,regdate,index_no,bbs_no) values ('','$firstno','$prevno','$thirdno','$category_num','$item_no','$content','n','$regdate','$index_no','$bbs_no')";
	$res = mysql_query($sql,$dbconn);


	echo "
		<script>
			alert('수정요청을 하였습니다.');window.close();
		</script>
	";
	exit;
}
?>
