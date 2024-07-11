<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
if (isset($flag) == false) {
$SQL = "select * from $Fav_ItemTable where fav_item_no = $fav_item_no and mart_id='$mart_id'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$item_no_ori = $ary["item_no"];
	$provider_id = $ary["provider_id"];
	$comment = $ary["comment"];
}
?>
<?
	include "../admin_head.php";
?>
<script>
function checkform(f){
	if(f.comment.value==""){
		alert("코멘트를 입력하세요.");
		f.comment.focus();
		return false;
	}
	return true;
}
</script>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top"><p align="left"><br>
    	<br>
    	<br>
    	</p>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%"><img src="../images/a3.gif" WIDTH="160" HEIGHT="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#98A043"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><br>
        		<small>▶</small> <font face="돋움">쇼핑몰의 <strong>테마상품</strong>을<strong> 
        		<br>
        		&nbsp;&nbsp; 관리</strong>합니다.<br>
        		</font><br>
        		
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#98A043" height="1"></td>
      	</tr>
    	</table>
    	
    	<p align="left"><br>
    	<br>
    </td>
    <td width="1" bgcolor="#808080"><br>
    </td>
    <td width="646" bgcolor="#FFFFFF" valign="top">
    	<div align="center"><center>
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top">　<p style="padding-left: 10px"><strong><span
        		class="cc">[베스트상품 등록]</strong> 등록되어진 제품 
        		중 베스트상품으로 등록합니다.<br>
        		등록한 베스트상품은 메인화면의 베스트상품영역에 출력됩니다.<br>
        		베스트상품 등록갯수제한은 없으나 3~4개 정도를 권장합니다.<br>
        		<br>
        		
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
      	
      	<form method="post" name="frm" onsubmit='return checkform(this)'>
		<input type="hidden" name="flag" value="update">
		<input type="hidden" name="fav_item_no" value='<?echo $fav_item_no?>'>
		
		<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<div align="left">
        		<table border="0" width="100%">
          		<tr>
            		<td width="1%" bgcolor="#FFFFFF"></td>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="20%" bgcolor="#C8DFEC" align="center">상품명</td>
                			<td size="80" bgcolor="#FFFFFF" align="center"><p align="left">&nbsp;
                				 
                				<?
								$SQL = "select * from $ItemTable where item_no=$item_no_ori";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								if($numRows > 0) {
									mysql_data_seek($dbresult, 0);
									$ary = mysql_fetch_array($dbresult);
									$item_name = $ary["item_name"];
								}
			            		echo $item_name;
			            		?>
			            		
			            	</td>
              			</tr>
              			<tr>
                			<td width="20%" bgcolor="#C8DFEC" align="center">코멘트</td>
                			<td size="80" bgcolor="#FFFFFF" align="center"><p align="left">&nbsp; 
                				
            					<input name="comment" value='<?echo $comment?>' size="80" maxlength='35' style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"> 35자 이내
			     			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="2">
                				
                				<p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 베스트상품으로 등록할 
                				제품을 선택하신 다음, 완료를 클릭하세요.
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		</div>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료">&nbsp; 
        		<input onclick="window.location.href='theme_item.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로">
        	</td>
      	</tr>
      	</form>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</body>
</html>
<?
}
elseif ($flag == "update") {
	$SQL = "update $Fav_ItemTable set comment = '$comment' where mart_id='$mart_id' and fav_item_no = $fav_item_no";
	$dbresult = mysql_query($SQL, $dbconn);

	if ($dbresult == false) echo "쿼리 실행 실패!";

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
?>
<?
mysql_close($dbconn);
?>