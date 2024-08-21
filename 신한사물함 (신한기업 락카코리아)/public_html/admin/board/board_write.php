<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$ary = mysql_fetch_array($dbresult);
$MemberName = $ary[name];
$MemberEmail = $ary[email];


$SQL = "select * from $New_BoardConfigTable where bbs_no = '$bbs_no' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0 ){
	mysql_data_seek($dbresult, 0);
	$ary = mysql_fetch_array($dbresult);
	$bbs_no = $ary[bbs_no];	
	$mart_id = $ary[mart_id];
	$board_title = $ary[board_title];	
	$board_comment = $ary[board_comment];	
	$board_date = $ary[board_date];	
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
	$userfile_use = $ary[userfile_use];
	$if_use_secret = $ary[if_use_secret]; 
}

if(isset($flag)==false || $flag != "write"){
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
//var blnBodyLoaded = false;
//var blnEditorLoaded = false;

/*function HandleLoad() {
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
}*/

function checkform(){
	var f = document.writeform;
	if (f.writer.value.length < 1){
		alert("성명을 입력하세요.")
		f.writer.focus();
		return false;
	}
	if (f.subject_new.value.length < 1){
		alert("글의 제목을 기입하시기 바랍니다.")
		f.subject_new.focus();
		return false;
	}

//	f.editBox.editmode = "html";
//	f.content.value = f.editBox.html;
	f.submit();	
}
</script>
<!-- <script event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</script> -->
<?
include_once('../../editor/func_editor.php');
$content = $content;
?>
<body topmargin="0" leftmargin='0' bgcolor="#FFFFFF">

<table border="1" cellpadding="0" cellspacing="0" width="99%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
	<form action='board_write.php' method="POST" name='writeform' enctype="multipart/form-data" onsubmit='return editor_wr_ok();'> 
	<input type="Hidden" name="flag" value="write">
	<input type="Hidden" name="bbs_no" value="<?=$bbs_no?>">
	<tr>
	<td width="100%">
		<table cellSpacing="0" cellPadding="0" width="100%" border="0">
			<tr>
			<td width="100%">
				<table cellSpacing="0" cellPadding="0" width="100%" border="0">
					<tr bgColor="#4a494a">
						<td width="100%" height="25" bgcolor="#F6F6F6"><p align="center">글쓰기</td>
					</tr>
					<tr>
						<td width="100%" height="1" bgcolor="#808080"></td>
					</tr>
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
											<td width="93%">
												<input name="writer" value='<?=$MemberName?>' size="20" class="input_03">
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 종류 : 
												<select name="code" class="input_03" style='width:100px'>
													<option value='1' selected>주문관련</option>
													<option value='2'>결제관련</option>
													<option value='3'>배송/반품관련</option>
													<option value='4'>회원관련</option>
													<option value='5'>기타질문</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="7%"><p align="left">제목 : </td>
											<td width="93%">
												<input name="subject_new" size="70" class="input_03">
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- <tr>
								<td width="100%" bgcolor="#FFFFFF" height="20" valign="center">
									<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
									<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
								</td>
							</tr> -->
							<tr>
								<td width="100%" bgcolor="#FFFFFF" align="center">
									<!-- <OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT> -->
								<?=myEditor(1,'../../editor','writeform','content','100%','200');?>
								</td>
							</tr>
<?
}else{
?>
							<tr>
								<td width="100%">
									<table border="0" width="100%">
										<tr>
											<td width="7%"><p align="left">이름 : </td>
											<td width="93%">
												<input name="writer" value='<?=$MemberName?>' size="10" class="input_03">
												<?
												if($bbs_no == '8'){
												?>
												<input name="open_chk" type="checkbox" value="y">공개
												<?
												}
												?>
<?
if( $board_class != 0 && $if_use_secret == '1'){
?>
										<input type='checkbox' name='if_secret' value='1'>잠금사용
<?
}
?>		
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 이메일 : 
												<input name="email" value='<?=$MemberEmail?>' size="30" class="input_03">
											</td>
										</tr>
										<tr>
											<td width="7%"><p align="left">제목 : </td>
											<td width="93%">
												<input name="subject_new" size="70" class="input_03">
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- <tr>
								<td width="100%" bgcolor="#FFFFFF" height="20" valign="center">
									<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
									<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
								</td>
							</tr> -->
							<tr>
								<td width="100%" bgcolor="#FFFFFF" align="center">
									<!-- <OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT> -->
									<?=myEditor(1,'../../editor','writeform','content','100%','200');?>
								</td>
							</tr>
<?
	if( $userfile_use == "y" ){//첨부파일 사용
?>
							<tr>
								<td width="100%">첨부파일1 : <input type='file' name='userfile' size="50" class="input_03"></td>
							</tr>	
							<tr>
								<td width="100%">첨부파일2 : <input type='file' name='userfile1' size="50" class="input_03"></td>
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
				</table>
			</td>
		</tr>
		<tr>
			<td align="right" height="10" width="100%" bgcolor="#FFFFFF"></td>
		</tr>
		<tr>
			<td align="right" height="1" width="100%" bgcolor="#808080"></td>
		</tr>
		<tr>
			<td align="right" height="25" width="100%" bgcolor="#F6F6F6" align="center">
				<input type="image" src="../../market/images/save.gif" onclick="return checkform();" border="0" WIDTH="48" HEIGHT="15">
				<a href="board_list.php?bbs_no=<?=$bbs_no?>"><img src="../../market/images/list.gif" border="0" WIDTH="46" HEIGHT="15"></a>
			</td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
</body>
</html>
<?
}
elseif ($flag == "write") {
	//=================== LOCK을 건다 ========================================================
	$query1 = " LOCK TABLES $New_BoardTable WRITE" ;
	mysql_query( $query1, $dbconn );

	//=================== 쓰레드 찾기 ========================================================
	$query2 = "select MAX(thread) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'";
	$result2 = mysql_query( $query2, $dbconn );
	$row2 = mysql_fetch_array( $result2 );
	$thread = $row2[0] + 1;

	//=================== 포지션 찾기 ========================================================
	$query3 = "select MIN(ansno) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'" ;
	$result3 = mysql_query( $query3, $dbconn );
	$row3 = mysql_fetch_array( $result3 );
	$ansno = $row3[0] + 1;

	//=================== 질문이후의 글들의 AnsNo 를 1씩 증가시킴 ========================
	$query4 = "update $New_BoardTable set ansno = ansno + 1 where (ansno > 0) and mart_id = '$mart_id' and bbs_no='$bbs_no'";
	mysql_query( $query4, $dbconn );

	//============= 최고 index_no 값을 찾아서 1을 더해주고 이 uid 값을 insert 시켜줌 =====
	$query6 = "select MAX(index_no) from $New_BoardTable where mart_id = '$mart_id'";
	$result6 = mysql_query( $query6, $dbconn );
	$row6 = mysql_fetch_array( $result6 );
	$index_no = $row6[0] + 1;

	//한글자르기
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

	$write_date = date("Ymd H:i:s");

	$content = str_replace( "<P>", "<br>", $content );
	//================== 업로드 함수 불러옴 ==================================================
	include "../../market/upload.php";
	$upload_dir = "$UploadRoot$mart_id/";
	//================== 첨부 파일을 업로드함 ================================================
	if( $userfile_name ){
		$file = FileUploadName( "", "$upload_dir", $userfile, $userfile_name );
	}
	if( $userfile1_name ){
		$file1 = FileUploadName( "", "$upload_dir", $userfile1, $userfile1_name );
	}
	
	$SQL = "insert into $New_BoardTable (index_no, bbs_no, mart_id, code, username, writer, passwd, doc_type, if_secret , write_date, msgno, ansno, thread, email, subject_new, content, userfile, userfile1,open_chk) values ('$index_no', '$bbs_no', '$mart_id', '$code', '$mart_id', '$writer', '$passwd', '$doc_type', '$if_secret', '$write_date', $maxMsgNo+1, '1', '$thread', '$email', '$subject_new_tmp[0]', '$content', '$file', '$file1', '$open_chk' )";
	$dbresult = mysql_query($SQL, $dbconn);

	//=================== LOCK을 푼다 ========================================================
	$query5 =" UNLOCK TABLES " ;
	mysql_query( $query5, $dbconn );

	echo "<meta http-equiv='refresh' content='0; URL=board_list.php?bbs_no=$bbs_no'>";
}
?>
<?
mysql_close($dbconn);
?>