<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
?>
<?
$SQL = "select perms from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, 0);
if($perms == "4") {
	echo ("		
	<script>
		alert('�̵�� ���θ��Դϴ�.');
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
				window.alert('ȸ������ �����Դϴ�.');
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
		alert('�����ڸ� ���� ���Ǽ� �ֽ��ϴ�.');
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
		alert("������ �Է��ϼ���.")
		f.writer.focus();
		return;
	}
	if (f.subject_new.value.length < 1){
		alert("���� ������ �����Ͻñ� �ٶ��ϴ�.")
		f.subject_new.focus();
		return;
	}
<?
if( $board_class == 0 ){
?>
	if (f.passwd.value.length < 1){
		alert("��й�ȣ�� ����/�����ÿ� �ʿ��մϴ�.")
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
<!---------------------- �Խ��� ���� ---------------------------------------------------->
<?
$SQL = "select * from $New_BoardTable where bbs_no='$bbs_no' and index_no=$index_no and mart_id = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if($dbresult == false) echo "���� ���� ����!";

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
										<input type='checkbox' name='if_secret' value='1' <?=$if_secret_checked?>>��ݻ��
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
								<input type='checkbox' name='if_secret' value='1'>��ݻ��
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
if( $userfile_use == "y" ){//÷������ ���
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
<!---------------------- �Խ��� �� ------------------------------------------------------>
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
	

#######################�����ܾ��ñ���################################	
	if(!$subject_new){
		$error_msg = '������ �Է����ּ���';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;		
	}
	if(!$content){
		$error_msg = '������ �Է����ּ���';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;		
	}

	if($tmp = rg_str_inword("hello,example,Arizona,family,purpose,doctrine,applied,very,broadly,holds,parents,liable,even,for,the,negligence,of,child,driving,motor,vehicle,in,defiance,of,driving,restrictions,pla,����,������,�湮��,����,����,boris,���볲,���뿩,aphsun.info,��ī��,����,���,Ư������,��ŷī��,�����,ǥ�ø�,�ʽ�,ȭ��,������,�Ǹ���,�ߵ�,ȭ��ä��,����̺�Ʈ,�����ϰ�,���̶�,���¯,�·���,��ũ��,(��)ī��,5000����,�����,�����,��@ī@��,õ����,Ű��,���ȸ������,�뵷,�ĩɩ�,��������,�ߵ�,������,�þ˸���,��Ʊ׶�,��ī��,��/ī/��,��ī����,����,����,ī����,������������,8��,��õid,��/õ/��,�١�ī�ٶ�,��(ī)��,����Ȯ��,�����ڷ�,����,viagra,��Ʊ׶�,sialis,�þ˸���,���˸���,����,����,viagra,��Ʊ׶�,sialis,����,����,��������,���,�ƽôºи�,�Ű���,�ٴ��̾߱�,�ǽ̰�,Ȳ�ݼ�,����,������,20����,100����,200����,Ȳ �� ��,��������,�渶,�ξ�,ȫ��,�ξ�,��ī��,Ư������,����,����,http,href,www,url,URL,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,��,��,��",$subject_new)) {
		$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}

	if($tmp = rg_str_inword("hello,example,Arizona,family,purpose,doctrine,applied,very,broadly,holds,parents,liable,even,for,the,negligence,of,child,driving,motor,vehicle,in,defiance,of,driving,restrictions,pla,����,������,�湮��,����,����,boris,���볲,���뿩,aphsun.info,��ī��,����,���,Ư������,��ŷī��,�����,ǥ�ø�,�ʽ�,ȭ��,������,�Ǹ���,�ߵ�,ȭ��ä��,����̺�Ʈ,�����ϰ�,���̶�,���¯,�·���,��ũ��,(��)ī��,5000����,�����,�����,��@ī@��,õ����,Ű��,���ȸ������,�뵷,�ĩɩ�,��������,�ߵ�,������,�þ˸���,��Ʊ׶�,��ī��,��/ī/��,��ī����,����,����,ī����,������������,8��,��õid,��/õ/��,�١�ī�ٶ�,��(ī)��,����Ȯ��,�����ڷ�,����,viagra,��Ʊ׶�,sialis,�þ˸���,���˸���,����,����,viagra,��Ʊ׶�,sialis,����,����,��������,���,�ƽôºи�,�Ű���,�ٴ��̾߱�,�ǽ̰�,Ȳ�ݼ�,����,������,20����,100����,200����,Ȳ �� ��,��������,�渶,�ξ�,ȫ��,�ξ�,��ī��,Ư������,����,����,http,href,www,url,URL,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,��,��,��",$content)) {
		$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}
#######################################################################
	//=================== LOCK�� �Ǵ� ========================================================
	$query1 = " LOCK TABLES $New_BoardTable WRITE" ;
	mysql_query( $query1, $dbconn );

	$SQL = "select max(index_no) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	$maxIndex_no = mysql_result($dbresult, 0, 0);	//index_no �ʵ� �ִ밪

	$SQL = "select index_no,ansno from $New_BoardTable where ansno >= $ansno and bbs_no='$bbs_no' and mart_id='$mart_id' order by ansno desc";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	$num_rows = mysql_num_rows($dbresult);

	//���������� �۵��� AnsNo �� 1�� ������Ŵ 
	for ($i=0; $i < $num_rows; $i++) {	
		$tmp_index_no = mysql_result($dbresult,$i,0);
		$tmp_ansno = mysql_result($dbresult,$i,1);
		$SQL2 = "update $New_BoardTable set ansno=$tmp_ansno+1 where index_no=$tmp_index_no and mart_id = '$mart_id' and bbs_no='$bbs_no'";
		$dbresult2 = mysql_query($SQL2, $dbconn);
	}

	$subject_new = str_replace( "\n", "<br>", $subject_new );
	$content = str_replace( "\n", "<br>", $content );

	$write_date = date("Ymd H:i:s");
	
	//�ѱ��ڸ���
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

	//================== ���ε� �Լ� �ҷ��� ==================================================
	include "../upload.php";
	//================== ÷�� ������ ���ε��� ================================================
	if( $userfile_name ){
		$file = FileUploadName( "", "$UploadRoot$mart_id/", $userfile, $userfile_name );
	}
	if( $userfile1_name ){
		$file1 = FileUploadName( "", "$UploadRoot$mart_id/", $userfile1, $userfile1_name );
	}
	
	$SQL = "insert into $New_BoardTable(index_no, bbs_no, mart_id, username, writer, passwd, write_date, ansno, step, thread, email, subject_new, content, userfile, userfile1, if_secret,writer_ip, user_id) values($maxIndex_no+1, $bbs_no, '$mart_id', '$UnameSess', '$writer', '$passwd', '$write_date', '$ansno', '$step', '$thread', '$email', '$subject_new_tmp[0]', '$content', '$file', '$file1', '$if_secret', '$REMOTE_ADDR', '$user_id_name')";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";

	//=================== LOCK�� Ǭ�� ========================================================
	$query5 =" UNLOCK TABLES " ;
	mysql_query( $query5, $dbconn );

	echo "<meta http-equiv='refresh' content='0; URL=http://www.jsbusan.com/market/board/board_list.php?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
}
?>
<?
mysql_close($dbconn);
?>
