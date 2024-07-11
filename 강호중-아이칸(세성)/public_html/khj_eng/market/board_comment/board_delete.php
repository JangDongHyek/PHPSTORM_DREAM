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

$SQL = "select password from $MemberTable where username = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0 ){
	$shop_password = mysql_result($dbresult,0,0);	
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
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows < 1){
		echo ("		
			<script>
			window.alert('회원전용 공간입니다.');
			parent.location.href='../member/login.php?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;
	}

}
if($board_class == 2){
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
	echo ("		
	<script>
		alert('관리자만 삭제할 수 있습니다.');
		history.go(-1);
	</script>
	");
	exit;
	}
}						

include( '../include/getmartinfo.php' );

if(!isset($flag) || $flag != "delete"){
	include('../include/head_alltemplate.php');

?>

<script>
function board_checkform(){
	var f = document.writeform;
	<?
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
	?>
	if (f.passwd.value.length < 1){
		alert("비밀번호를 입력하세요.")
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
$SQL = "select * from $New_BoardTable where area='$item_no' and index_no='$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$ary = mysql_fetch_array($dbresult);

$writer = $ary[writer];
$email = $ary[email];
$subject_new = $ary[subject_new];
$content = $ary[content];
$if_secret = $ary[if_secret];
$user_file = $ary[userfile];
$user_file1 = $ary[userfile1];

$subject_new = eregi_replace( "<br>", "", $subject_new );
$content = eregi_replace( "<br>", "", $content );
?>			
						<form method="POST" name='writeform' onsubmit='board_checkform(); return false'> 
						<input type="Hidden" name="flag" value="delete">
						<input type="Hidden" name="mart_id" value="<?=$mart_id?>">
						<input type="Hidden" name="content" value="<?=htmlspecialchars($content)?>">
						<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
						<input type="hidden" name="item_no" value="<?=$item_no?>">
						<input type="hidden" name="page" value="<?=$page?>">
						<input type="hidden" name="keyset" value="<?=$keyset?>">
						<input type="hidden" name="searchword" value="<?=$searchword?>">
					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10"><img src="../image/helpdesk/table1_left.gif" width="10" height="40"></td>
							<td width="60" align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/subject.gif" width="20" height="40"></td>
							<td width="1"><img src="../image/helpdesk/table1_line.gif" width="1" height="40"></td>
							<td background="../image/helpdesk/table1_bg.gif"> &nbsp;&nbsp;<input name="subject_new" value='<?=$subject_new?>' type="text" class="category_2" size="90" style='ime-mode:active'></td>
							<td width="10"><img src="../image/helpdesk/table1_right.gif" width="10" height="40"></td>
						</tr>
					</table>

					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="70" height="30" align="center"><img src="../image/helpdesk/view_writer.gif" width="60" height="30"></td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type="text" class="input_03" size="40" name="writer" value='<?=$writer?>' style='ime-mode:active'></td>
						</tr>
						<tr>
						  <td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_email.gif" width="40" height="30"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td ><input name="email" value='<?=$email?>' type="text" class="input_03" size="30" style='ime-mode:inactive'></td>
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
								<input type='checkbox' name='if_secret' value='1'  <?if($if_secret == '1') echo "checked"?>>잠금사용
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
							<td height='300'><textarea name="content" cols="90" rows="20" class="input_03"><?=$content?></textarea></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?
if( $userfile_use == "y" ){//첨부파일 사용
?>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_file.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type='file' name='userfile' size="50"></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_file.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
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
							<td height="50" align="center"><input type='image' onfocus='blur();' src="../image/helpdesk/bu_delete.gif" width="70" height="30" border="0"><a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>"><img src="../image/helpdesk/bu_cancel.gif" width="70" height="30" border="0"></a></td>
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
<script>
document.writeform.passwd.focus();
</script>
</body>
</html>
<?
}
else if($flag == "delete"){
	$SQL = "select passwd, userfile, userfile1, thread from $New_BoardTable where index_no=$index_no and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	
	$row = mysql_fetch_array($dbresult);

	$passwd_db = $row[passwd];
	$username = $row[username];
	$userfile = $row[userfile];
	$userfile1 = $row[userfile1];
	$thread = $row[thread];


	if($Mall_Admin_ID&&$MemberLevel==1){ 
	
		$upload = "$UploadRoot$mart_id/";
		if( $userfile ){ //해당번호에 파일이 있다면 파일을 삭제함
			$desc = "{$upload}{$userfile}";
			unlink($desc);
		}
		if( $userfile1 ){ //해당번호에 파일이 있다면 파일을 삭제함
			$desc1 = "{$upload}{$userfile1}";
			unlink($desc1);
		}

		$SQL = "delete from $New_BoardTable where index_no = $index_no and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";

		//관련 코멘트 삭제
		$SQL = "delete from board_comment where index_no = '$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);

		echo "<meta http-equiv='refresh' content='0; URL=board_list.php?item_no=$item_no&mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
	}

	else if($passwd_db != $passwd && $shop_password != $passwd){
		echo ("
			<script language='javascript'>
			alert('비밀번호가 정확하지 않습니다.');
			</script>
		");	

		echo "<meta http-equiv='refresh' content='0; URL=board_delete.php?item_no=$item_no&mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
	}else{
		//==================== 리플이 있으면 리플의 step 을 1씩 줄임 =====================
		/*$sql0 = "select * from $New_BoardTable where thread='$thread' and mart_id = '$mart_id' and bbs_no='$bbs_no'";
		$res0 = mysql_query( $sql0, $dbconn );
		$tot0 = mysql_num_rows( $res0 );
		if( $tot0 ){
			$sql1 = "update $New_BoardTable set step = step - 1 where thread='$thread' and mart_id = '$mart_id' and bbs_no='$bbs_no'";
			$res1 = mysql_query( $sql1, $dbconn );
			if( !$res1 ){
				echo "
				<script>
					window.alert('리플 업데이트에 실패했습니다.');
					history.go(-1);
				</script>
				";
				exit;
			}
		}*/

		$upload = "$UploadRoot$mart_id/";
		if( $userfile ){ //해당번호에 파일이 있다면 파일을 삭제함
			$desc = "{$upload}{$userfile}";
			unlink($desc);
		}
		if( $userfile1 ){ //해당번호에 파일이 있다면 파일을 삭제함
			$desc1 = "{$upload}{$userfile1}";
			unlink($desc1);
		}

		$SQL = "delete from $New_BoardTable where index_no = $index_no and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";

		//관련 코멘트 삭제
		$SQL = "delete from board_comment where index_no = '$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);

		echo "<meta http-equiv='refresh' content='0; URL=board_list.php?item_no=$item_no&mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
	}
}
?>
<?
mysql_close($dbconn);
?>