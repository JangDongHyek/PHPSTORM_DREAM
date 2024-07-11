<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">
<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?	
$SQL = "select perms from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, 0);
if($perms == "4") {
	echo ("		
	<script>
		alert('미등록 쇼핑몰입니다.');
		history.go(-1);
	</script>
	");
	exit;
}

$SQL = "select * from $New_BoardConfigTable where mart_id = '$mart_id' and bbs_no = '$bbs_no'";
$dbresult = mysql_query($SQL, $dbconn);
$ary = mysql_fetch_array($dbresult);

$board_title = $ary[board_title];	
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

if($bbs_no == 7 && !$_SESSION["Mall_Admin_ID"])
{
	echo ("		
	<script>
		alert('관리자만 글을 쓰실수 있습니다.');
		history.go(-1);
	</script>
	");
	exit;
}

if( $board_class == 1 || $board_class == 3 ){
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows < 1 && !$_SESSION["Mall_Admin_ID"]){
		echo ("		
			<script>
			window.alert('회원전용 공간입니다.');
			parent.location.href='../member/login.html?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;
	}
}

if($board_class == 2){
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
	echo ("		
	<script>
		alert('관리자만 글을 쓰실수 있습니다.');
		history.go(-1);
	</script>
	");
	exit;
	}
}

include( '../include/getmartinfo.php' );
if(isset($flag)==false || $flag != "write"){
	include('../include/head_alltemplate.php');
?>
<script language="javascript">
<!--
/*function goTo(){
	var f=document.boardchange;
	f.action="board.php";
	f.submit();
}*/
//-->
</script>
<script>
/*var blnBodyLoaded = false;
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

function board_checkform(){
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
<?
if( $board_class == 0 ){
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
?>
	if (f.passwd.value.length < 1){
		alert("비밀번호는 수정/삭제시에 필요합니다.")
		f.passwd.focus();
		return;
	}
<?
	}
}
?>
	//f.editBox.editmode = "html";
	//f.content.value = f.editBox.html;
	var content = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
	if(content=="")
	{
			alert("내용을 적어주세요!");
			ed.focus();
			return false;
	}
	f.submit();	
}
</script>
<script event="onscriptletevent(name, eventData)" for=editBox>
/*if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}*/
</script>
 
<?
if( $top_body ){
	//include "$top_body";
}
if( $headhtml ){
	echo "<br>$headhtml";
}
?>
<script src="../../editor/easyEditor.js"></script>
    <div class="wrap">
<!---------------------- 게시판 시작 ---------------------------------------------------->
					<form method="POST" name='writeform' enctype="multipart/form-data" onsubmit='board_checkform(); return false'> 
					<input type="hidden" name="flag" value="write">
					<input type="hidden" name="mart_id" value="<?=$mart_id?>">
					<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
					<input type="hidden" name="item_no" value="<?=$item_no?>">
					<input type="hidden" name="return" value="<?=$return?>">
					<table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10"><img src="../image/helpdesk/table1_left.gif" width="10" height="40"></td>
							<td width="60" align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/subject.gif"></td>
							<td width="1"><img src="../image/helpdesk/table1_line.gif" width="1" height="40"></td>
							<td background="../image/helpdesk/table1_bg.gif" style="padding-bottom:3px;"> &nbsp;&nbsp;<input name="subject_new" type="text" size="90" style='ime-mode:active' class="input_03"></td>
							<td width="10"><img src="../image/helpdesk/table1_right.gif" width="10" height="40"></td>
						</tr>
					</table>

					<table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="70" height="30" align="center"><img src="../image/helpdesk/view_writer.gif" width="60" height="30"></td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type="text" class="input_03" size="20" name="writer" value='<?=$MemberName?>' style='ime-mode:active'>



												열람분류 : <select name="code" class="input_03" style='width:100px'>
												   <option value='1' selected>전체공개</option>
													<option value='2'>등록권한</option>
													<option value='3'>수정권한</option>
													<option value='4'>삭제권한</option>
													<option value='5'>일반회원</option>
												</select>(해당 권한자들만 글이 노출됩니다)

<?
if( $board_class != 0 && $if_use_secret == '1'){
?>
										<input type='checkbox' name='if_secret' value='1'>잠금사용
<?
}
?>
<?
if($Mall_Admin_ID&&$MemberLevel==1){	
?>
<input type="checkbox" name="notice_no" value="y">공지
<?}?>

							</td>
						</tr>
						<tr>
						  <td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_email.gif" width="40" height="30"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td ><input name="email" value='<?=$MemberEmail?>' type="text" class="input_03" size="30" style='ime-mode:inactive'></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?
if( $board_class == 0 ){
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
?>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_pass.gif" width="60" height="30"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td>
								<input type='password' name="passwd" class="input_03" size="20" style='ime-mode:inactive'>
<?
if($if_use_secret == '1'){
?>	
								<input type='checkbox' name='if_secret' value='1'>잠금사용
<?
}
?>							
							</td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?
	}
}
?>
						<tr>
							<td height="30" align="center" valign="top"><img src="../image/helpdesk/view_content.gif" width="20" height="30"></td>
							<td valign="top"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td height='300'><textarea name="content" id="content" style="width:100%;height:290px"><?=$content?></textarea></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>

						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_file.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type='file' name='userfile' size="50" class="input_03"></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_file.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type='file' name='userfile1' size="50" class="input_03"></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>

					</table>
<script>
		var ed = new easyEditor("content"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>					<table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50" align="center"><input type='image' onfocus='blur();' src="../image/helpdesk/bu_writeok.gif" border="0" ><a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>"><img src="../image/helpdesk/bu_cancel.gif" border="0"></a></td>
						</tr>
					</table>
					</form>
<!---------------------- 게시판 끝 ------------------------------------------------------>
    </div>
<?
if( $bottom_body ){
	//include "$bottom_body";
}
if( $tailhtml ){
	echo "<br>$tailhtml";
}
?>
</body>
</html>

<?
	if($board_class == 1){
	}
}
elseif ($flag == "write") {
#######################금지단어팅구기################################	

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

	//============= 최고 index_no 값을 찾아서 1을 더해주고 이 uid 값을 insert 시켜줌 =========
	$query6 = "select MAX(index_no) from $New_BoardTable where mart_id = '$mart_id'";
	$result6 = mysql_query( $query6, $dbconn );
	$row6 = mysql_fetch_array( $result6 );
	$index_no = $row6[0] + 1;
	
	$subject_new = str_replace( "\n", "<br>", $subject_new );
	$content = str_replace( "\n", "<br>", $content );

	//한글자르기
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

	$write_date = date("Ymd H:i:s");

	//================== 업로드 함수 불러옴 ==================================================
	include "../upload.php";
	$upload_dir = "$UploadRoot$mart_id/";
	// 워터마크 서버경로
	$watermark_path = $upload_dir."__watermark.png";		
	//================== 첨부 파일을 업로드함 ================================================
	if( $userfile_name ){
		$file = FileUploadName( "", "$upload_dir", $userfile, $userfile_name );
		//echo "$upload_dir". $userfile_name;

		// 워터마킹
		$arr_result = waterMarkImage("$upload_dir".$file, $watermark_path, 50, 100);
		/*if(!$arr_result["bool"])
		{
			echo $arr_result["error"];
			exit;
		}*/		
	}
	if( $userfile1_name ){
		$file1 = FileUploadName( "", "$upload_dir", $userfile1, $userfile1_name );

		// 워터마킹
		$arr_result = waterMarkImage("$upload_dir".$file1, $watermark_path, 50, 100);
	}
	if($notice_no == "y"){
		
		$que = "select max(notice_no) from $New_BoardTable where bbs_no='$bbs_no'";
		$result = mysql_query($que, $dbconn);
		$max_notice = mysql_result($result,0,0);

		if($max_notice == 0){
			$max_notice = "100000";
		}else{
			$max_notice = $max_notice + 1;
		}

	}
	if(!$max_notice){
		$max_notice = "0";
	}	
	$SQL = "insert into $New_BoardTable (index_no, bbs_no, notice_no, mart_id, code, username, writer, passwd, write_date, ansno, step, thread, email, subject_new, content, userfile, userfile1, if_secret, writer_ip, area) values ('$index_no', $bbs_no, '$max_notice', '$mart_id', '$code', '$UnameSess', '$writer', '$passwd', '$write_date', '1', '0', '$thread', '$email', '$subject_new_tmp[0]', '$content', '$file', '$file1', '$if_secret', '$REMOTE_ADDR', '$item_no')";
	$dbresult = mysql_query($SQL, $dbconn);
	if( !$dbresult ){
		echo "
			<script>
				window.alert('글 작성에 실패했습니다');
				history.go(-1);
			</script>
		";
		exit;
	}
	//=================== LOCK을 푼다 ========================================================
	$query5 =" UNLOCK TABLES " ;
	mysql_query( $query5, $dbconn );

	if( $return == "product" ){
		echo "
			<script>
				window.alert('글을 작성했습니다');
				window.close();
				window.opener.location.reload();
			</script>
		";
		exit;
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=board_list.php?mart_id=$mart_id&bbs_no=$bbs_no'>";
	}
}
?>
<?
mysql_close($dbconn);
?>