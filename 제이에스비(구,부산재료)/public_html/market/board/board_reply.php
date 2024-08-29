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

if( $board_class == 1 || $board_class == 3 ){
	if($_SESSION["UnameSess"]<>"admin"){
		$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows < 1){
			echo ("		
				<script>
				window.alert('회원전용 공간입니다.');
				parent.location.href='../member/login.html?url=$url&mart_id=$mart_id';
				//parent.location.href='../member/login.php?url=$url&mart_id=$mart_id';
				</script>
			");
			exit;	
		}
	}
}

if($board_class == 2){
	echo ("		
	<script>
		alert('관리자만 글을 쓰실수 있습니다.');
		history.go(-1);
	</script>
	");
	exit;
}						

include( '../include/getmartinfo.php' );
if ($flag == ""){
	include('../include/head_alltemplate.php');
?>
<script language="javascript">
<!--
	/*
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
?>
	if (f.passwd.value.length < 1){
		alert("비밀번호는 수정/삭제시에 필요합니다.")
		f.passwd.focus();
		return;
	}
<?
}
?>
	//f.editBox.editmode = "html";
	//f.content.value = f.editBox.html;
	f.submit();	
}
//-->
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
	include "$top_body";
}
if( $headhtml ){
	echo "<br>$headhtml";
}
?>
<!---------------------- 게시판 시작 ---------------------------------------------------->
<?
$SQL = "select * from $New_BoardTable where bbs_no='$bbs_no' and index_no=$index_no and mart_id = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if($dbresult == false) echo "쿼리 실행 실패!";

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
?>
										
					<form method="POST" name='writeform' enctype="multipart/form-data" onsubmit='board_checkform(); return false' action="https://www.jsbusan.com:8026/market/board/board_reply.php"> 
					<input type="hidden" name="flag" value="write">
					<input type="hidden" name="mart_id" value="<?=$mart_id?>">
					<input type="hidden" name="page" value="<?=$page?>">
					<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
					<input type="hidden" name="keyset" value="<?=$keyset?>">
					<input type="hidden" name="searchword" value="<?=$searchword?>">
					<input type="hidden" name="ansno" value="<?=$ansno?>">
					<input type="hidden" name="step" value="<?=$step?>">
					<input type="hidden" name="thread" value="<?=$thread?>">
					<input type="hidden" name="user_id_name" value="<?=$row[username]?>">
				<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10"><img src="../image/helpdesk/table1_left.gif"></td>
							<td width="60" align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/subject.gif"></td>
							<td width="1"><img src="../image/helpdesk/table1_line.gif"></td>
							<td background="../image/helpdesk/table1_bg.gif"> &nbsp;&nbsp;<input name="subject_new" value='<?=$subject_new?>' type="text" class="category_2" size="90" style='ime-mode:active'></td>
							<td width="10"><img src="../image/helpdesk/table1_right.gif"></td>
						</tr>
					</table>

					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="70" height="30" align="center"><img src="../image/helpdesk/view_writer.gif"></td>
							<td width="1"><img src="../image/helpdesk/view_line.gif"></td>
							<td width="10"></td>
							<td><input type="text" class="input_03" size="20" name="writer" value='<?=$MemberName?>' style='ime-mode:active'>
<?
if( $board_class != 0 && $if_use_secret == '1'){
						if($row[if_secret] == 1){
							$if_secret_checked = "checked";
						}
?>
										<input type='checkbox' name='if_secret' value='1' <?=$if_secret_checked?>>잠금사용
<?
}
?>							
							</td>
						</tr>
						<tr>
						  <td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_email.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif"></td>
							<td width="10"></td>
							<td ><input name="email" value='<?=$MemberEmail?>' type="text" class="input_03" size="30" style='ime-mode:inactive'></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?
if( $board_class == 0 ){
?>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_pass.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif"></td>
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
?>
						<tr>
							<td height="30" align="center" valign="top"><img src="../image/helpdesk/view_content.gif"></td>
							<td valign="top"><img src="../image/helpdesk/view_line.gif"></td>
							<td width="10"></td>
							<td height='300'><textarea name="content" cols="90" rows="20" class="input_03"></textarea></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?
if( $userfile_use == "y" ){//첨부파일 사용
?>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_file.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif"></td>
							<td width="10"></td>
							<td><input type='file' name='userfile' size="50"></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_file.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif"></td>
							<td width="10"></td>
							<td><input type='file' name='userfile1' size="50"></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?
}	
?>
					</table>
					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50" align="center"><input type='image' onfocus='blur();' src="../image/helpdesk/bu_reply.gif" border="0">&nbsp;<a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>"><img src="../image/helpdesk/bu_cancel.gif" border="0"></a></td>
						</tr>
					</table>
					</form>
<!---------------------- 게시판 끝 ------------------------------------------------------>
<?
if( $bottom_body ){
	include "$bottom_body";
}
if( $tailhtml ){
	echo "<br>$tailhtml";
}
?>
</body>
</html>

<?
}
else if($flag == "write"){
	

#######################금지단어팅구기################################	
	if(!$subject_new){
		$error_msg = '제목을 입력해주세요';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;		
	}
	if(!$content){
		$error_msg = '내용을 입력해주세요';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;		
	}

	if($tmp = rg_str_inword("hello,example,Arizona,family,purpose,doctrine,applied,very,broadly,holds,parents,liable,even,for,the,negligence,of,child,driving,motor,vehicle,in,defiance,of,driving,restrictions,pla,싸이,투데이,방문자,추적,버그,boris,현대남,현대여,aphsun.info,목카드,도박,장비,특수렌즈,마킹카드,공장목,표시목,필승,화투,포르노,뽀르노,야동,화상채팅,대박이벤트,영계하고,데이또,재미짱,승률이,테크노,(바)카라,5000만원,입출금,생방송,바@카@라,천만원,키스,대박회원급증,용돈,㈓㈘㈑,강원랜드,야동,정력제,시알리스,비아그라,바카라,바/카/라,바카현이,섹스,폰섹,카지노,㉥┝㉪┝㉣┝,8억,추천id,추/천/인,바☆카☆라,바(카)라,남근확대,무료자료,━★,viagra,비아그라,sialis,시알리스,씨알리스,동거,섹스,viagra,비아그라,sialis,동거,섹스,프릴리지,상륙,아시는분만,신개념,바다이야기,피싱걸,황금성,물뽕,게임장,20원방,100원방,200원방,황 금 성,무료증정,경마,로얄,홍콩,부업,목카드,특수렌즈,도박,토토,http,href,www,url,URL,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,※,◀,▶",$subject_new)) {
		$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}

	if($tmp = rg_str_inword("hello,example,Arizona,family,purpose,doctrine,applied,very,broadly,holds,parents,liable,even,for,the,negligence,of,child,driving,motor,vehicle,in,defiance,of,driving,restrictions,pla,싸이,투데이,방문자,추적,버그,boris,현대남,현대여,aphsun.info,목카드,도박,장비,특수렌즈,마킹카드,공장목,표시목,필승,화투,포르노,뽀르노,야동,화상채팅,대박이벤트,영계하고,데이또,재미짱,승률이,테크노,(바)카라,5000만원,입출금,생방송,바@카@라,천만원,키스,대박회원급증,용돈,㈓㈘㈑,강원랜드,야동,정력제,시알리스,비아그라,바카라,바/카/라,바카현이,섹스,폰섹,카지노,㉥┝㉪┝㉣┝,8억,추천id,추/천/인,바☆카☆라,바(카)라,남근확대,무료자료,━★,viagra,비아그라,sialis,시알리스,씨알리스,동거,섹스,viagra,비아그라,sialis,동거,섹스,프릴리지,상륙,아시는분만,신개념,바다이야기,피싱걸,황금성,물뽕,게임장,20원방,100원방,200원방,황 금 성,무료증정,경마,로얄,홍콩,부업,목카드,특수렌즈,도박,토토,http,href,www,url,URL,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,※,◀,▶",$content)) {
		$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}
#######################################################################
	//=================== LOCK을 건다 ========================================================
	$query1 = " LOCK TABLES $New_BoardTable WRITE" ;
	mysql_query( $query1, $dbconn );

	$SQL = "select max(index_no) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	$maxIndex_no = mysql_result($dbresult, 0, 0);	//index_no 필드 최대값

	$SQL = "select index_no,ansno from $New_BoardTable where ansno >= $ansno and bbs_no='$bbs_no' and mart_id='$mart_id' order by ansno desc";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	$num_rows = mysql_num_rows($dbresult);

	//질문이후의 글들의 AnsNo 를 1씩 증가시킴 
	for ($i=0; $i < $num_rows; $i++) {	
		$tmp_index_no = mysql_result($dbresult,$i,0);
		$tmp_ansno = mysql_result($dbresult,$i,1);
		$SQL2 = "update $New_BoardTable set ansno=$tmp_ansno+1 where index_no=$tmp_index_no and mart_id = '$mart_id' and bbs_no='$bbs_no'";
		$dbresult2 = mysql_query($SQL2, $dbconn);
	}

	$subject_new = str_replace( "\n", "<br>", $subject_new );
	$content = str_replace( "\n", "<br>", $content );

	$write_date = date("Ymd H:i:s");
	
	//한글자르기
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

	//================== 업로드 함수 불러옴 ==================================================
	include "../upload.php";
	//================== 첨부 파일을 업로드함 ================================================
	if( $userfile_name ){
		$file = FileUploadName( "", "$UploadRoot$mart_id/", $userfile, $userfile_name );
	}
	if( $userfile1_name ){
		$file1 = FileUploadName( "", "$UploadRoot$mart_id/", $userfile1, $userfile1_name );
	}
	
	$SQL = "insert into $New_BoardTable(index_no, bbs_no, mart_id, username, writer, passwd, write_date, ansno, step, thread, email, subject_new, content, userfile, userfile1, if_secret,writer_ip, user_id) values($maxIndex_no+1, $bbs_no, '$mart_id', '$UnameSess', '$writer', '$passwd', '$write_date', '$ansno', '$step', '$thread', '$email', '$subject_new_tmp[0]', '$content', '$file', '$file1', '$if_secret', '$REMOTE_ADDR', '$user_id_name')";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";

	//=================== LOCK을 푼다 ========================================================
	$query5 =" UNLOCK TABLES " ;
	mysql_query( $query5, $dbconn );

	echo "<meta http-equiv='refresh' content='0; URL=http://www.jsbusan.com/market/board/board_list.php?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
}
?>
<?
mysql_close($dbconn);
?>
