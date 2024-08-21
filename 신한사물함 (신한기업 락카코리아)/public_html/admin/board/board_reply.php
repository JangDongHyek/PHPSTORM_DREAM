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
if ($flag == ""){
	include "../admin_head.php";
?>
<script>
/**var blnBodyLoaded = false;
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

*/
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
//$content = $content;
?>
<body topmargin="0" leftmargin='0' bgcolor="#FFFFFF">
<table border="1" cellpadding="0" cellspacing="0" width="99%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">

	<tr>
	<td width="100%">
		<table cellSpacing="0" cellPadding="0" width="100%" border="0">
			<tr>
				<td width="100%">
					<table cellSpacing="0" cellPadding="0" width="100%" border="0">
					<tr bgColor="#4a494a">
						<td width="100%" height="25" bgcolor="#F6F6F6"><p align="center">답변글쓰기</td>
					</tr>
					<tr>
						<td width="100%" height="1" bgcolor="#808080"></td>
					</tr>
					<tr>
						<td bgColor="#FFFFFF"></td>
					</tr>
<?
$SQL = "select * from $New_BoardTable where index_no=$index_no and mart_id='$mart_id' and bbs_no = '$bbs_no'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "쿼리 실행 실패!";

$row = mysql_fetch_array( $dbresult );

$writer = $row[writer];
$subject_new = $row[subject_new];
$content = $row[content];
$passwd = $row[passwd];
$if_secret = $row[if_secret];
//$content = htmlspecialchars($content, ENT_QUOTES);

$ansno = $row[ansno];
$ansno = $ansno + 1;

$step = $row[step];
$step = $step + 1;
$thread = $row[thread];

$item_no = $row[area];

if( $bbs_no == '3' ){
	switch( $code ){
		case "1" : 
			$code_str = "[주문관련]";
			break;
		case "2" : 
			$code_str = "[결제관련]";
			break;
		case 3 : 
			$code_str = "[배송/반품관련]";
			break;
		case 4 : 
			$code_str = "[회원관련]";
			break;
		case 5 : 
			$code_str = "[기타질문]";
			break;
	}
}


if( $bbs_no == "6" ){ //상품 Q&A 일때
	if( $item_no ){ //상품 정보가 있을때
		//================== 상품 정보를 불러옴 ======================================
		$item_sql = "select * from $ItemTable where mart_id='$mart_id' and item_no='$item_no'";
		$item_res = mysql_query($item_sql, $dbconn);
		$item_tot = mysql_num_rows($item_res);

		/*$item_row = mysql_fetch_array($item_res);

		if($step == 0){
			$j_str = "[Q] [".$item_row[item_name]."]";
		}else{
			$j_str = "[A] [".$item_row[item_name]."]";
		}*/
	}
}
?>								
					<form method="POST" name='writeform' enctype="multipart/form-data" onsubmit='return editor_wr_ok();'> 
					<input type="hidden" name="flag" value="write">
					<!-- <input type="hidden" name="content" value="<?=htmlspecialchars($content, ENT_QUOTES)?>"> -->
					<input type="hidden" name="page" value="<?=$page?>">
					<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
					<input type="hidden" name="keyset" value="<?=$keyset?>">
					<input type="hidden" name="searchword" value="<?=$searchword?>">
					<input type="hidden" name="ansno" value="<?=$ansno?>">
					<input type="hidden" name="step" value="<?=$step?>">
					<input type="hidden" name="thread" value="<?=$thread?>">
					<input type="hidden" name="item_no" value="<?=$item_no?>">
					<input type="hidden" name="user_id_name" value="<?=$row[username]?>">
					<tr>
						<td bgColor="#FFFFFF" align="center">
							<table border="0" width="90%">
								<tr>
								<td width="100%">
									
									<table border="0" width="100%">
										<tr>
											<td width="7%" height="10"></td>
											<td width="93%" height="10"></td>
										</tr>
										<tr>
											<td width="7%"><p align="left">이름 : </td>
											<td width="93%">
												<input name="writer" value='<?=$MemberName?>' size="10" class="input_03">
<?
if( $board_class != 0 && $if_use_secret == '1'){
						if($if_secret == 1){
							$if_secret_checked = "checked";
						}
?>
										<input type='checkbox' name='if_secret' value='1' <?=$if_secret_checked?>>잠금사용
<?
}
?>							

												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;이메일 : 
												<input name="email" value='<?=$MemberEmail?>' size="30" class="input_03">
									</td>
										</tr>
										<tr>
											<td width="7%" align="left">제목 : </td>
											<td width="93%">
<?
if( $item_no ){
?>
												<input name="subject_new" size="70" value='<?=$subject_new?>' class="input_03" value="">
<?
}else{
?>
												<input name="subject_new" size="70" value='<?=$subject_new?>' class="input_03" value="└ Re :">
<?
}
?>
											</td>
										</tr>
										<tr>
											<td width="7%"></td>
											<td width="93%"></td>
										</tr>
									</table>
								</td>
								</tr>
								<!-- <tr>
							<td width="100%" bgcolor="#FFFFFF" height="13" valign="top">
								<p style="padding-left: 40px">
								<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
								<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
							</td>
						</tr> -->
						<tr>
							<td width="100%" bgcolor="#FFFFFF"><p align="center">
							<!-- <OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT> --><?=myEditor(1,'../../editor','writeform','content','100%','200');?>
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
						<tr>
								<td width="100%">
<?
if($if_use_secret == '1' && $if_secret == '1'){
?>
									<input type='hidden' name='passwd' value='<?=$passwd?>'>
<?
}else{
?>
									비밀번호 : <input type='password' name='passwd' size='12' class="input_03">
<?
}	
?>
<?
if($if_use_secret == '1' && $if_secret == '1'){
?>	
									<input type='hidden' name='if_secret' value='1'>&nbsp;비밀글 답변은 자동으로 비밀글이 됩니다.
<?
}
?>
								</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" bgcolor="#808080" height="1"></td>
					</tr>
					<tr>
						<td align='center' bgcolor='#F6F6F6' height='25'>
							<input type="image" src='../../market/images/save.gif' border='0' width='48' height='15' onclick="return checkform();">
							<a href='board_list.php?bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../../market/images/list.gif' border='0' width='46' height='15'></a>
						</td>
					</tr>
					<tr>
						<td align="center" bgcolor="#808080" height="1"></td>
					</tr>
					</form>
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
else if($flag == "write"){
	//=================== LOCK을 건다 ========================================================
	$query1 = " LOCK TABLES $New_BoardTable WRITE" ;
	mysql_query( $query1, $dbconn );

	$SQL = "select max(index_no) from $New_BoardTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	$maxIndex_no = mysql_result($dbresult, 0, 0);	//index_no 필드 최대값

	$SQL = "select max(msgno) from $New_BoardTable where bbs_no = '$bbs_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	$max_msgno = mysql_result($dbresult, 0, 0);	//msgno 최대값

	$SQL = "select ansno, step from $New_BoardTable where index_no='$index_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	$ansansno = mysql_result($dbresult, 0, 0);	//질문 글의 AnsNo
	$ansstep = mysql_result($dbresult, 0, 1);		//질문 글의 Step

	$SQL = "select * from $New_BoardTable where ansno >= $ansansno and bbs_no = '$bbs_no' and mart_id='$mart_id' order by ansno desc";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	$num_rows = mysql_num_rows($dbresult);

	//=================== 질문이후의 글들의 AnsNo 를 1씩 증가시킴 ========================
	$query4 = "update $New_BoardTable set ansno = ansno + 1 where ansno >= $ansno and mart_id = '$mart_id' and bbs_no='$bbs_no'";
	mysql_query( $query4, $dbconn );

	$write_date = date("Ymd H:i:s");
	
	//한글자르기
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

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

	if( $bbs_no == "6" && $item_no ){
		$SQL = "insert into $New_BoardTable(index_no, bbs_no, mart_id, username, writer, passwd, write_date, msgno, ansno, step, thread, email, subject_new, content, userfile, userfile1, if_secret, area) values($maxIndex_no+1, $bbs_no, '$mart_id', '$mart_id', '$writer', '$passwd', '$write_date', $max_msgno+1, '$ansno', '$step', '$thread', '$email', '$subject_new_tmp[0]', '$content', '$file', '$file1', '$if_secret', '$item_no')";
	}else{
		$SQL = "insert into $New_BoardTable(index_no, bbs_no, mart_id, username, writer, passwd, write_date, msgno, ansno, step, thread, email, subject_new, content, userfile, userfile1, if_secret,user_id) values($maxIndex_no+1, $bbs_no, '$mart_id', '$mart_id', '$writer', '$passwd', '$write_date', $max_msgno+1, '$ansno', '$step', '$thread', '$email', '$subject_new_tmp[0]', '$content', '$file', '$file1', '$if_secret', '$user_id_name')";
	}

	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";

	//=================== LOCK을 푼다 ========================================================
	$query5 =" UNLOCK TABLES " ;
	mysql_query( $query5, $dbconn );

	echo "<meta http-equiv='refresh' content='0; URL=board_list.php?bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
}
?>
<?
mysql_close($dbconn);
?>