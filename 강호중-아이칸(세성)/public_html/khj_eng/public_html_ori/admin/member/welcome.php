<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $Member_WelcomeTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$doctype = mysql_result($dbresult, 0, "doctype");
		$message = mysql_result($dbresult, 0, "message");
		$bg_img = mysql_result($dbresult, 0, "bg_img");
		$message = htmlspecialchars($message);
	}

	include "../admin_head.php";
?>
<script language="javascript">
<!-- 
function input_chk(){ 
	var message = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
	if(message=="")
	{
			alert("내용을 적어주세요!");
			ed.focus();
			return false;
	}
		
	return true;
}
//-->
</script>
<script src="../../editor/easyEditor.js"></script>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu1.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/main_title.gif" width="310" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">기본설정</span> &gt; <span class="text_gray2_c">축하메시지 </span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500">
			<!--왼쪽부분시작-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 

?>
			<!--왼쪽부분 END-->	  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>축하메세지</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<form method=post  name=writeform onsubmit='return input_chk();'>
			<input type='hidden' name='flag' value='update'>

			<tr>
				<td width="100%" bgcolor="#FFFFFF"><p align="center"><textarea name="message" id="message"><?=$message?></textarea>	
 <script>
		var ed = new easyEditor("message"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>						</td>
			  </tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="완료">&nbsp; 
					<input class="aa" onclick='init()' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="재입력">&nbsp; 
					<input class="aa" onclick='prev_win()' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="Preview">
				</td>
			</tr>
			</form>
		</table>
		<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
}
elseif ($flag == "update") {
	$SQL = "select * from $Member_WelcomeTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$SQL = "update $Member_WelcomeTable set message = '$message', bg_img = '$bg_img' where mart_id='$mart_id'";
	}else{
		$SQL = "insert into $Member_WelcomeTable (mart_id, message, bg_img) values ('$mart_id', '$message', '$bg_img')";
	}

	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=welcome.php'>";
}
?>	
<?
mysql_close($dbconn);
?>