<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $New_BoardConfigTable where bbs_no = '$bbs_no' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0 ){
	$ary = mysql_fetch_array($dbresult);
	$bbs_no = $ary[bbs_no];	
	$mart_id = $ary[mart_id];	
	$board_title = $ary[board_title];	
	$board_comment = $ary[board_comment];	
	$board_date = $ary[board_date];
	$comment_ok = $ary[comment_ok];
	$item_fg_color = $ary[item_fg_color];	
	$item_bg_color = $ary[item_bg_color];	
	$table_fg_color = $ary[table_fg_color];	
	$table_bg_color = $ary[table_bg_color];	
	$headhtml = $ary[headhtml];
	$tailhtml = $ary[tailhtml];
	$top_body = $ary[top_body];
	$bottom_body = $ary[bottom_body];		
	$board_class = $ary[board_class];	
	$pagecount = $ary[pagecount];
	$if_use_secret = $ary[if_use_secret];
	$userfile_use = $ary[userfile_use];
}						

if(!isset($flag) || $flag != "update"){
?>
<?
	include "../admin_head.php";
?>
<script language="javascript">
<!--
function goTo(){
	var f=document.boardchange;
	f.action="board.php";
	f.submit();
}
//-->
</script>
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
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.content.value;
	f.editBox.focus();
	f.editBox.setFocus();
}


function checkform(){
	var f = document.writeform;
	if (f.writer.value.length < 1){
		alert("성명을 입력하세요.")
		f.writer.focus();
		return;
	}
	if (f.subject_new.value.length < 1){
		alert("글의 제목을 기입하시기 바랍니다.")
		f.subject_new.focus();
		return;
	}

	f.editBox.editmode = "html";
	f.content.value = f.editBox.html;
	f.submit();	
}
</script>
<script event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</script>
</head>

<body onload='HandleLoad()' topmargin="0" leftmargin='0' bgcolor="#FFFFFF">
<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">

	<tr>
	<td width="100%">
		<table cellSpacing="0" cellPadding="0" width="100%" border="0">
			<tr>
				<td width="100%">
					<table cellSpacing="0" cellPadding="0" width="100%" border="0">
					<tr bgColor="#4a494a">
						<td width="100%" height="25" bgcolor="#F6F6F6"><p align="center">수정하기</td>
					</tr>
					<tr>
						<td width="100%" height="1" bgcolor="#808080"></td>
					</tr>
<?
$SQL = "select * from $New_BoardTable where index_no=$index_no and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "쿼리 실행 실패!";
$numRows = mysql_num_rows($dbresult);
if($numRows > 0 ){
	$ary = mysql_fetch_array($dbresult);
	$code = $ary[code];
	$writer = $ary[writer];
	$passwd = $ary[passwd];
	$doc_type = $ary[doc_type];
	$write_date = $ary[write_date];
	$email = $ary[email];
	$subject_new = $ary[subject_new];
	$content = $ary[content];
	$if_secret = $ary[if_secret];
	$user_file = $ary[userfile];
	$user_file1 = $ary[userfile1];
}
?>				
				<form method="POST" name='writeform' enctype="multipart/form-data"> 
				<input type="Hidden" name="flag" value="update">
				<input type="Hidden" name="content" value="<?=htmlspecialchars($content, ENT_QUOTES)?>">
				<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
				<input type="hidden" name="page" value="<?=$page?>">
				<input type="hidden" name="keyset" value="<?=$keyset?>">
				<input type="hidden" name="searchword" value="<?=$searchword?>">
				<input type='hidden' name='user_file' value='<?=$user_file?>'>
				<input type='hidden' name='user_file1' value='<?=$user_file1?>'>
					<tr>
						<td bgColor="#FFFFFF" align="center">
							<table border="0" width="90%">
<?
if( $bbs_no == '3' ){
?>
								<tr>
									<td width="100%">
										<table border="0" width="100%">
											<tr>
												<td width="7%"><p align="left">이름 : </td>
												<td width="43%">
													<input name="writer" value='<?=$writer?>' size="20" class="input_03">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 종류 : 
													<select name="code" class="input_03" style='width:100px'>
														<option value='1' <?if($code==1){ echo "selected";}?>>주문관련</option>
														<option value='2' <?if($code==2){ echo "selected";}?>>결제관련</option>
														<option value='3' <?if($code==3){ echo "selected";}?>>배송/반품관련</option>
														<option value='4' <?if($code==4){ echo "selected";}?>>회원관련</option>
														<option value='5' <?if($code==5){ echo "selected";}?>>기타질문</option>
													</select>
												</td>
												<td width='7%'>작성일</td>
												<td width='40%'><input name="write_date" size="18" value='<?=$write_date?>' class="input_03"></td>
											</tr>
											<tr>
												<td width="7%"><p align="left">제목 : </td>
												<td width="93%" colspan='3'>
													<input name="subject_new" value='<?=$subject_new?>' size="70" class="input_03">
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#FFFFFF" height="20" valign="center">
										<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
										<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
									</td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#FFFFFF"><p align="center">
									<OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT>
									</td>
								</tr>
<?
}else{
?>
								<tr>
									<td width="100%">
										<table border="0" width="100%">
											<tr>
												<td width="13%" height="10"></td>
												<td width="87%" height="10"></td>
											</tr>
											<tr>
												<td width="13%"><p align="left">
													이름 : </td>
												<td width="87%">
													<input name="writer" size="20" value='<?=$writer?>' class="input_03">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 이메일 : 
													<input name="email" size="30" value='<?=$email?>' class="input_03">
												</td>
											</tr>
											<tr>
												<td width="13%">제목 : </td>
												<td width="87%"><input name="subject_new" size="70" value='<?=$subject_new?>' class="input_03"></td>
											</tr>
											<tr>
											<td width="13%">
												<p align="left">작성일 : </td>
											<td width="87%">
												<input name="write_date" size="18" value='<?=$write_date?>' class="input_03"></td>
											</tr>
											<tr>
												<td width="13%"></td>
												<td width="87%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#FFFFFF" height="13" valign="top">
										<p style="padding-left: 40px">
										<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
										<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
									</td>
								</tr>
								<tr>
									<td width="100%" bgcolor="#FFFFFF"><p align="center">
									<OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT>
									</td>
								</tr>
<?
	if( $userfile_use == "y" ){//첨부파일 사용
?>
								<tr>
									<td width="100%">첨부파일1 : <input type='file' name='userfile' size="50" class="input_03"><?=$user_file?></td>
								</tr>	
								<tr>
									<td width="100%">첨부파일2 :  <input type='file' name='userfile1' size="50" class="input_03"><?=$user_file1?></td>
								</tr>
<?
	}	
?>
<?
}
?>
							</table>
						</td>
					</tr>
					</form>
					<tr>
						<td align="center" bgcolor="#808080" height="1"></td>
					</tr>
					<tr>
						<td align='center' bgcolor='#F6F6F6' height='25'>
							<a href='javascript:checkform()'><img src='../../market/images/mod.gif' border='0' WIDTH='50' HEIGHT='15'></a>
							<a href='board_list.php?bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../../market/images/list.gif' border='0' width='46' height='15'></a>
						</td>
					</tr>
					<tr>
						<td align="center" bgcolor="#808080" height="1"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
	</td>
	</tr>
</table>
</body>
</html>
<?
}
else if($flag == "update"){
	$SQL = "select * from $New_BoardTable where index_no=$index_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";

	$ary = mysql_fetch_array($dbresult);

	//한글자르기
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

	//================== 업로드 함수 불러옴 ==================================================
	include "../../market/upload.php";
	$upload_dir = "$UploadRoot$mart_id/";

	if( $userfile_name ){//첨부 파일을 업로드 했으면 파일명을 수정함
		$file = FileUploadName( "$user_file", "$upload_dir", $userfile, $userfile_name );
		$sql = "update $New_BoardTable set userfile='$file' where index_no='$index_no' and mart_id='$mart_id'";
		$res = mysql_query( $sql, $dbconn );

		if( !$res ){
			echo("
				<script>
				window.alert('이미지를 수정하는데 실패했습니다!');
				history.go(-1)
				</script>
			");
			exit;
		}
	}
	if( $userfile1_name ){//첨부 파일을 업로드 했으면 파일명을 수정함
		$file1 = FileUploadName( "$user_file1", "$upload_dir", $userfile1, $userfile1_name );
		$sql = "update $New_BoardTable set userfile1='$file1' where index_no='$index_no' and mart_id='$mart_id'";
		$res = mysql_query( $sql, $dbconn );

		if( !$res ){
			echo("
				<script>
				window.alert('이미지를 수정하는데 실패했습니다!');
				history.go(-1)
				</script>
			");
			exit;
		}
	}
	$content = str_replace( "<P>", "<br>", $content );

	$SQL = "update $New_BoardTable set code='$code', writer='$writer', doc_type = '$doc_type', email='$email', subject_new='$subject_new_tmp[0]', content='$content', write_date = '$write_date' where index_no = $index_no and mart_id='$mart_id'";
	
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	echo "<meta http-equiv='refresh' content='0; URL=board_read.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";

}
?>
<?
mysql_close($dbconn);
?>