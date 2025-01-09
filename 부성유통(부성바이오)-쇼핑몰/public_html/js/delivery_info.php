<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $MartIntroTable where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	$ary = mysql_fetch_array($dbresult);
	$delivery = $ary["delivery"];
	$delivery = htmlspecialchars($delivery, ENT_QUOTES);

	include "../admin_head.php";
?>
<script language="javascript">
<!-- 
	/*
function input_chk(){ 
	var delivery = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
	if(delivery=="")
	{
			alert("내용을 적어주세요!");
			ed.focus();
			return false;
	}
		
	return true;
}*/
//-->
</script>
<script language="Javascript" src="../../webnote/webnote.js"></script>
<script language="javascript" src="../../js/jquery-1.7.min.js"></script>
<script language="Javascript">
<!--

webnote_config = {

	base_dir: "../../webnote",					//다른 디렉토리에 설치했을때
	css_url: "../../webnote/webnote.css",		//다른 css 파일을 사용할 때
	emoticon_dir: "../../webnote/emoticon"		//다른 이모티콘 디렉토리를 사용할때

//	fonts: ["굴림체","궁서체"],				//선택할 수 있는 폰트종류를 직접 정의
//	fontsizes: ["9pt","10pt"],				//선택할 수 있는 폰트사이즈를 직접 정의
//	lineheights: ["120%","150%","180%"],	//선택할 수 있는 줄간격을 직접 정의
//	emoticons: ["smile","cry"],				//선택할 수 있는 이모티콘종류를 직접 정의(png 확장자파일의 파일명만 나열)
//	specialchars: ["§","☆]					////선택할 수 있는 특수문자를 직접 정의

}

function checkForm(form) {
	var $delivery=$("#delivery").val();
	//alert(delivery.value);
	//return false;
	if($delivery == "") {
		alert("내용1을 입력해주세요");
		//focusWebNote("contents1");		//에디터에 포커스를 주기위한 webnote 내장함수
		return false;
	}
	return false;

	//return true;
}
//-->
</script>

<!--
<script src="../../editor/easyEditor.js"></script>-->

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
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">기본설정</span> &gt; <span class="text_gray2_c">배송안내 설정 </span> </div></td>
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
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>배송안내 설정</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<form name='form' method='post' onsubmit='return checkForm(this)' enctype="multipart/form-data">
				<input type='hidden' name='flag' value='update'>
					<tr>
						<td height="35"><b>상품설명의 배달정보에 나타날 내용을 <!--html로--> 직접 작성하세요.</b></td>
					</tr>
					<tr>
						<td width='100%' bgcolor='#FFFFFF' align="center" style="overflow:hidden">
						<textarea name="delivery" style="position:fixed;overflow:hidden" id="delivery" editor="webnote" tools="deny:images,hr,textbox,note,sourcebox,emoticon,fullscreen"><?=$delivery?></textarea>	 <script>
		/*var ed = new easyEditor("delivery"); //초기화 id속성값
		ed.init(); //웹에디터 삽입*/
</script>  						</td>
					</tr>					
					<tr>
						<td width="100%" bgcolor="#FFFFFF" align="center" height="40">
							<input type="submit" class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" value="완료">&nbsp; 
							<input class="aa" onclick='document.form.reset();' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="재입력"> 
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
	$sql1 = "update $MartIntroTable set delivery = '$delivery' where mart_id='$mart_id'";
//	echo $sql1;
	$res1 = mysql_query($sql1, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=$PHP_SELF'>";
}
?>	
<?
mysql_close($dbconn);
?>