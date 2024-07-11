<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false) {
	
	if (isset($prevno) == false) $prevno = 0;
	
	$SQL = "select * from $CatalogTable where catalog_no = $catalog_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows >0){
		mysql_data_seek($dbresult, 0);
		$ary = mysql_fetch_array($dbresult);
		$catalog_no = $ary["catalog_no"];
		$mart_id = $ary["mart_id"];
		$title = $ary["title"];
		$date = $ary["date"];
		$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
		$content = htmlspecialchars($ary["content"]);
		$img = $ary["img"];
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
	var f = document.writeform;
	f.editBox.editmode = sMode;
}
function re_init(f) {
	f.reset();
	init();
}
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.content.value;
	f.editBox.focus();
	f.editBox.setFocus();
}


function checkform(f){
	if (f.title.value.length < 1){
		alert("제목을 적어주세요!!")
		f.title.focus();
		return false;
	}
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
<script language="javascript">
function fileup(formname,imagename){
	var url = "../file_upload.php?formname="+formname+"&imagename="+imagename
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}
</script>

<body onload='HandleLoad()' bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "5";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>카탈로그</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" align="center"><strong>[카탈로그 게시물 수정]</strong>등록된 게시물을 수정합니다.<br></td>
				</tr>

<form method=post  name=writeform onsubmit='return checkform(this)'>
<input type="hidden" name="flag" value="update">
<input type="hidden" name="catalog_no" value="<?echo $catalog_no?>">
<input type=hidden name=content value='<?echo $content?>'>
<input type="hidden" name="updateflag">
					
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><center>
					
					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#999999">
								
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="15%" bgcolor="#C8DCA9" align="center">제목</td>
									<td width="85%" bgcolor="#FFFFFF" align="center" colspan="2"><p align="left">
										<input name="title" value='<?echo $title?>' size="70" class="input_03"></td>
								</tr>
								<tr>
									<td width="15%" bgcolor="#C8DCA9" align="center">현재 이미지</td>
									<td width="85%" bgcolor="#FFFFFF" align="center" colspan="2">
										<p align="left">
										<img src='<?echo "$Co_img_DOWN$mart_id/$img"?>'>
										</td>
								</tr>
								<tr>
									<td width="15%" bgcolor="#C8DCA9" align="center">바꿀 이미지</td>
									<td width="85%" bgcolor="#FFFFFF" align="center" colspan="2">
										<p align="left">
										<input name="img" size="50" value='<?echo $img?>' class="input_03" readonly>
										&nbsp;&nbsp;&nbsp; 
										<input onclick="javascript:fileup('writeform','img');"  style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드"></td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#C8DCA9" align="center" colspan="3">내용</td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#FFFFFF" align="center" colspan="3">
										<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
									<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력
											<br>
										
										<table>
											<tr>
											<td bgColor="#ffffff" width="100%"><p align="center">
												<OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT><br>
											</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="50%" bgcolor="#C8DCA9" align="center" colspan="2">등록일</td>
									<td width="50%" bgcolor="#FFFFFF" align="center"><?echo $date_str?>
									</td>
								</tr>
								</table>
							</td>
						</tr>
					</table>
					</center></div>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" align="center">
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정완료">
					<input onclick="re_init(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="재입력">
					<input onclick="window.location.href='catalog_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로">
				</td>
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
}
elseif ($flag == "update") {
	if (isset($img)&&($img != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			$img_new = "catalog_".$catalog_no."_".$img;

			if(file_exists("$Co_img_UP$mart_id/$img"))
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
		}
		else{
			$img_new = $img;
		}
		
	}
	
	$SQL = "update $CatalogTable set title = '$title', content = '$content', img = '$img_new' where catalog_no = $catalog_no and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=catalog_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>