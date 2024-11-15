<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == ""){
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows>0){
		$ary = mysql_fetch_array($dbresult);

		$agreement = $ary[agreement];
		$privacy = $ary[privacy];
		$agreement = eregi_replace( "<br>", "\n", $agreement );
		$privacy = eregi_replace( "<br>", "\n", $privacy );
	}

	/*$filename = "$Co_img_UP$mart_id/agreement";
	if(file_exists($filename)){
		$fp = fopen($filename,"r");
		$agreement = fread($fp, filesize ($filename));
		$agreement = htmlspecialchars($agreement);
		fclose($fp);
	}

	$filename1 = "$Co_img_UP$mart_id/privacy";
	if(file_exists($filename1)){
		$fp1 = fopen($filename1,"r");
		$privacy = fread($fp1, filesize ($filename1));
		$privacy = htmlspecialchars($privacy);
		fclose($fp1);
	}*/
	$SQL = "select content from $Cart_ExplainTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$content = mysql_result($dbresult, 0, 0);
		$content = htmlspecialchars($content);
	}

	include "../admin_head.php";
?>
<script>
var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	document.writeform.editBox.editmode = sMode;
}
function init() {
	var f = document.writeform;
	if (f.content.value != "") {
		f.editBox.html = f.content.value;
	}
	//document.all.editBox.setBgColor();

	f.editBox.focus();
	f.editBox.setFocus();
}


function checkform(f){
	f.editBox.editmode = "html";
	f.content.value = f.editBox.html;
	return true;
}
</script>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onLoad="InitializeStaticMenu(); HandleLoad()">
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
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">기본설정</span> &gt; <span class="text_gray2_c">이용약관</span> </div></td>
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
			<!--왼쪽부분 END-->		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>이용약관</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

	<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
		<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
		</tr>
		<tr>
		  <td width="100%" bgcolor="#FFFFFF" height="13" valign="top">
		  사업자는 회원등록을 받기 전에 회원에게 
		  약관내용을 명시하여 동의를 받은 후 <br>
		  회원등록을 받아야 합니다. (약관규제에 관한 법률 제3조 참조). <br>
		  다음은 공정거래위 심의를 받은 <strong>전자상거래 표준약관</strong>입니다.<br>
		  상점명등의 부분적인 수정 후 사용하시기 바라며, 이용약관은 
		  회원가입시 출력됩니다. </td>
		</tr>
<form action='article.php' method="post">
<input type="hidden" name="flag" value="update">

		<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
		</tr>
		<tr>
		  <td width="100%" bgcolor="#FFFFFF" align="center" height="35"><strong>1, 이용약관 입력 </strong>(하단에 오는 
		  &quot;공정거래규악에 따른 온라인쇼핑몰 이용약관&quot;에도 동시 적용됩니다.)</td>
		</tr>
		<tr>
		  <td width="100%" bgcolor="#FFFFFF"><p align="center"><textarea cols="75" name="agreement" rows="21" class="input_03" style="width:90%"><?echo $agreement?></textarea>
		  </td>
		</tr>
		<tr>
			<td bgcolor="#33A6B3" height="3" colspan="1"></td>
		</tr>
		<tr>
		  <td width="100%" bgcolor="#FFFFFF" align="center" height="35"><strong>2, 개인정보보호방침 입력 </strong>(★부분에 회사명등 쇼핑몰에 맞게 변경하세요.)</td>
		</tr>
		<tr>
		  <td width="100%" bgcolor="#FFFFFF"><p align="center">
		  <textarea cols="75" name="privacy" rows="21" class="input_03" style="width:90%"><?echo $privacy?></textarea></td>
		</tr>
		<tr>
		  <td width="100%" bgcolor="#FFFFFF" align="center" height="3"></td>
		</tr>
		<tr>
		  <td width="100%" bgcolor="#FFFFFF" align="center" height="3"><p align="center">
				<input  style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="완료">&nbsp; 
				<input  style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="재입력"><br><br></td>
		</tr>
	  </form>		
	</table>
<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}elseif($flag == "update"){
	/*$agreement = stripslashes($agreement);
	if(!file_exists("$Co_img_UP$mart_id")){
		mkdir("$Co_img_UP$mart_id", 0755 );
	}	
	$fp = fopen("$Co_img_UP$mart_id/agreement", "w");
	fwrite($fp, $agreement);
	fclose($fp);	
	
	$privacy = stripslashes($privacy);
	$fp1 = fopen("$Co_img_UP$mart_id/privacy", "w");
	fwrite($fp1, $privacy);
	fclose($fp1);*/
	$agreement = str_replace( "\n", "<br>", $agreement );
	$privacy = str_replace( "\n", "<br>", $privacy );

	$SQL = "update $MartMngInfoTable set agreement='$agreement', privacy='$privacy' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 

	if( $dbresult ){ 
		echo "<meta http-equiv='refresh' content='0; URL=article.php'>";
		exit;
	}else{
		echo "
		<script>
			alert('작성에 실패했습니다.');
			history.go(-1);
		</script>
		";
		exit;
	}
}elseif($flag == "update1"){
	
	$SQL = "select * from $Cart_ExplainTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 
	$numRows = mysql_num_rows($dbresult);
	if($numRows == 0){
		$SQL = "insert into $Cart_ExplainTable(mart_id, content)
		values('$mart_id', '$content')";
	}	
	else{
		$SQL = "update $Cart_ExplainTable set content = '$content' where mart_id='$mart_id'";
	}
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=article.php'>";
}
?>
<?
mysql_close($dbconn);
?>