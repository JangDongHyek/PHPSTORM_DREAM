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
function input_chk(){ 
	oEditors.getById["delivery"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

	var content=oEditors.getById["delivery"].getIR();
	content=content.replace("<P>&nbsp;</P>","");
	if (content== "" ){ 
		 alert("내용을 입력하세요."); 
		 oEditors.getById["delivery"].exec("FOCUS", []); 
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
				<form name='form' method='post' onsubmit='return input_chk()' enctype="multipart/form-data">
				<input type='hidden' name='flag' value='update'>
					<tr>
						<td height="35"><b>상품설명의 배송정보에 나타날 내용을 직접 작성하세요.</b></td>
					</tr>
					<tr>
						<td width='100%' bgcolor='#FFFFFF' align="center">
						<!--------------------------------------- 에디터 시작 ------------------------------------------------------>
<script type="text/javascript" src="../../smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<input type='hidden' name='secontent' value=''>
<textarea name="delivery" id="delivery" rows="10" cols="100" style="width:773px; height:412px; display:none;"><?=$delivery?></textarea>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "delivery",
	sSkinURI: "../../smarteditor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		fOnBeforeUnload : function(){
			//alert("아싸!");	
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["delivery"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["delivery"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["delivery"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	alert(form.ir1.value);
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.



	try {
		return false;
		//elClickedObj.form.submit();
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["delivery"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>

						<!--<textarea name="delivery" id="delivery"><?=$delivery?></textarea>	
 <script>
		var ed = new easyEditor("delivery"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>  					-->	</td>
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