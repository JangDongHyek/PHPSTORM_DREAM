<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 설정 파일을 불러옴 =============================================
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

if($board_class == 1){	
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows < 1 && !$_SESSION["Mall_Admin_ID"]){
		echo ("		
			<script>
			window.alert('회원전용 공간입니다.');
			//parent.location.href='../member/login.html?url=$url&mart_id=$mart_id';
			parent.location.href='../member/login.php?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;	
	}
}

//===================== 조회수를 1 증가함 ======================================
$SQL = "update $New_BoardTable set read_num = read_num +1 where bbs_no='$bbs_no' and index_no = $index_no and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "쿼리 실행 실패!";

include( '../include/getmartinfo.php' );
include('../include/head_alltemplate.php');
?>

<script>
function checkform(f){
	if(f.user_pass.value==''){
		alert("비밀번호를 입력하세요.");
		f.user_pass.focus();
		return false;
	}
	return true;	
}	
function delcheck(num1){
	var remessage = "다시확인 합니다. \n\n삭제하시겠습니까?";

	if(confirm(remessage)){
		location.href="board_delete_3.php?mart_id=<?=$mart_id?>&flag=delete&index_no=<?=$index_no?>&=&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&bbs_no="+num1;
	}
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
$SQL = "select * from $New_BoardTable where index_no = $index_no and bbs_no='$bbs_no' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$ary = mysql_fetch_array($dbresult);

//회원제게시판1,2 일고 잠금기능 글일때 본인과 관리자 아니면 글 못보게
if($board_class == 2 || $board_class == 3){	
	if($ary[if_secret] == 1){
		
		if($UnameSess){
			$UnameSess = $UnameSess;
		}else{
			$UnameSess = "no_value";
		}

		if($ary[username] == "$UnameSess" || $Mall_Admin_ID || $ary[user_id] == "$UnameSess"){
			$read_ok_good = "y";
		}
		if($read_ok_good != "y"){
			echo ("		
				<script>
				window.alert('글작성자 외에 볼수 없습니다.');
				history.go(-1);
				exit;
				</script>
			");
			exit;	
		}
	}
}


$username = $ary[username];
$writer = $ary[writer];
$user_id = $ary[username];
$email = $ary[email];
$passwd = $ary[passwd];
$write_date = $ary[write_date];
$read_num = $ary[read_num];	
$ansno = $ary[ansno];
$subject_new = $ary[subject_new];
	$subject_new = str_replace("아토피","***",$subject_new);
	$subject_new = str_replace("여드름","***",$subject_new);
	$subject_new = str_replace("기미","**",$subject_new);
	$subject_new = str_replace("주근깨","***",$subject_new);
	$subject_new = str_replace("주근께","***",$subject_new);
	$subject_new = str_replace("미백","**",$subject_new);
	$subject_new = str_replace("주름","**",$subject_new);
	$subject_new = str_replace("자외선차단","*****",$subject_new);
	$subject_new = str_replace("자외선 차단","*****",$subject_new);
$content = $ary[content];

	$content = str_replace("아토피","***",$content);
	$content = str_replace("여드름","***",$content);
	$content = str_replace("기미","**",$content);
	$content = str_replace("주근깨","***",$content);
	$content = str_replace("주근께","***",$content);
	$content = str_replace("미백","**",$content);
	$content = str_replace("주름","**",$content);
	$content = str_replace("자외선차단","*****",$content);
	$content = str_replace("자외선 차단","*****",$content);


$if_secret = $ary[if_secret];
$userfile = $ary[userfile];
$userfile1 = $ary[userfile1];

$subject_new = eregi_replace( "\'", "'", $subject_new );
$content = eregi_replace( "\'", "'", $content );

$content = get_link($content);

//========================= 이미지 태그내의 스크립트 방지 ================================
$src = "/<img .*src=[a-z0-9\"']*script:[^>]+>/i";
$des = "";
$content = preg_replace($src, $des, $content);




if($ary[index_no] < '218'){
	$content = nl2br($content);
}


//========================================================================================

$write_date_str = substr($write_date,0,4)."/".substr($write_date,4,2)."/".substr($write_date,6,2);

//========================= 회원 아이콘이 있으면 아이콘을 작성자에 표시 ==================
if( $user_id ){
	//========================= 관리자 아이콘이 있으면 아이콘을 작성자에 표시 ============
	$sql0 = "select admin_img from $MemberTable where username='$user_id'";
	$res0 = mysql_query( $sql0 , $dbconn );
	$row0 = mysql_fetch_array( $res0 );
	if( $row0[admin_img] ){
		$member_img = "<img src='../../up/$mart_id/$row0[admin_img]' border='0' align='absmiddle' height='20'>";
	}else{
		$member_img = $writer;
	}

	if( !$row0[admin_img] ){
		//========================= 회원 아이콘이 있으면 아이콘을 작성자에 표시 ==========
		$sql1 = "select member_img from $Mart_Member_NewTable where username='$user_id'";
		$res1 = mysql_query( $sql1 , $dbconn );
		$row1 = mysql_fetch_array( $res1 );
		if( $row1[member_img] ){
			$member_img = "<img src='../../up/$mart_id/$row1[member_img]' border='0' align='absmiddle' height='20'>";
		}else{
			$member_img = $writer;
		} 
	}
}else{
	$member_img = $writer;
}
//========================= 이메일이 있으면 작성자에 링크함 ==============================
if( $email ){
	$member_img = "<a href='mailto:$email'>$member_img</a>";
}

//========================= 첨부파일처리 =================================================
//========================= 그림파일이 있을때 출력 =======================================
$upload = "../../up/$mart_id/"; //업로드 디렉토리

$target = "$upload"."$userfile";
$target1 = "$upload"."$userfile1";
$encode_target = "$upload".urlencode("$userfile");
$encode_target1 = "$upload".urlencode("$userfile1");
//========================= userfile =====================================================
if( eregi("\.jpg", $userfile) || eregi("\.gif", $userfile) || eregi("\.JPG", $userfile) || eregi("\.GIF", $userfile) ){
	//==================== 이미지 사이즈를 구함 ==========================================
	$img_size = GetImageSize("$target"); 

	if( eregi("\.jpg", $userfile) || eregi("\.gif", $userfile) || eregi("\.JPG", $userfile) || eregi("\.GIF", $userfile) ){
		$img_width = $img_size[0]; //이미지의 넓이를 알 수 있음 
		$img_height = $img_size[1]; //이미지의 높이를 알 수 있음
	}

	//=============================== 가로,세로 비율에 맞게 이미지 맞추기 ================
	if( $userfile ){
		list( $height_new, $width_new ) = img_size( "$target", "600", "1000");
	}

	$img_file = "<img src='$encode_target' width='$width_new' height='$height_new' border='0' hspace='5' style='border: #000000; border-style: solid; border-width:1px'><br>".$img_file;
}else if(eregi("\.swf", $userfile)){
	$img_file = "<embed src='$encode_target' border='0'><br>".$img_file;
}

if( $userfile ){
	//========================== 파일 사이즈를 구함 ======================================
	$size = filesize($target);
	//========================== 파일 사이즈를 이쁘게 꾸밈 ===============================
	$size = GetFileSize($size);
}
//========================= userfile1 ====================================================
if( eregi("\.jpg", $userfile1) || eregi("\.gif", $userfile1) || eregi("\.JPG", $userfile1) || eregi("\.GIF", $userfile1)){
	//==================== 이미지 사이즈를 구함 ==========================================
	$img_size1 = GetImageSize("$target1");

	if( eregi("\.jpg", $userfile1) || eregi("\.gif", $userfile1) || eregi("\.JPG", $userfile1) || eregi("\.GIF", $userfile1)){
		$img_width1 = $img_size1[0]; //이미지의 넓이를 알 수 있음 
		$img_height1 = $img_size1[1]; //이미지의 높이를 알 수 있음
	}

	//=============================== 가로,세로 비율에 맞게 이미지 맞추기 ================
	if( $userfile1 ){
		list( $height_new1, $width_new1 ) = img_size( "$target1", "600", "1000");
	}

	$img_file1 = "<img src='$encode_target1' width='$width_new1' height='$height_new1' border='0' hspace='5' style='border: #000000; border-style: solid; border-width:1px'><br>".$img_file1;
}else if(eregi("\.swf", $userfile1)){
	$img_file1 = "<embed src='$encode_target1' border='0'><br>".$img_file1;
}

if( $userfile1 ){
	$size1 = filesize($target1);
	$size1 = GetFileSize($size1);
}
//========================= 첨부파일처리 =================================================

if( $board_class == 1 || $board_class == 3 ){ //자신의 글 수정,삭제는 본인만
	if( $username == "$UnameSess" ){
		$mod_perm = "<a href='board_edit.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_modify.gif' width='70' height='30' border='0'></a>";
		$del_perm = "<img src='../image/helpdesk/bu_delete.gif' width='70' height='30' border='0' style='cursor:hand' onclick='delcheck($bbs_no)'>";
	}else{
		$mod_perm = "";
		$del_perm = "";
	}
}else{
	$mod_perm = "<a href='board_edit.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_modify.gif' width='70' height='30' border='0'></a>";
	$del_perm = "<a href='board_delete.php?mart_id=$mart_id&flag=del&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_delete.gif' width='70' height='30' border='0'></a>";
}
if($if_use_secret == '1' && $if_secret=='1' && $passwd != $user_pass && !$Mall_Admin_ID){
	if($user_pass != ''){
		echo "
		<script>
		alert(\"비밀번호가 틀립니다.\");
		</script>
		";
	}	
?>
 				<table cellSpacing="0" cellPadding="0" width="680" align="center" border="0">
				<form name='f' action='board_read.php' method='post' onsubmit="return checkform(this)">
				<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
				<input type='hidden' name='index_no' value='<?=$index_no?>'>
				<input type='hidden' name='bbs_no' value='<?=$bbs_no?>'>
				<input type='hidden' name='page' value='<?=$page?>'>
				<input type='hidden' name='keyset' value='<?=$keyset?>'>
				<input type='hidden' name='searchword' value='<?=$searchword?>'>
          
          <tr>
            <td width="100%">
				
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10"><img src="../image/helpdesk/table1_left.gif" width="10" height="40"></td>
								<td align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/pass_type.gif" width="150" height="40"></td>
								<td width="10"><img src="../image/helpdesk/table1_right.gif" width="10" height="40"></td>
							</tr>
							<tr>
								<td height="10" colspan="3"></td>
							</tr>
						</table>
						<!--비밀번호입력-->
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="../image/helpdesk/view_table_top.gif" width="680" height="10"></td>
							</tr>
							<tr>
								<td background="../image/helpdesk/view_table_bg.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
										<tr>
											<td height="200" align="center"><table width="33%"  border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="100"><img src="../image/helpdesk/pass_img.gif" width="80" height="110" align="absmiddle"></td>
														<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td align="center"><img src="../image/helpdesk/pass_type1.gif" width="122" height="30"></td>
																</tr>
																<tr>
																	<td height="35" align="center"><input type='password' name="user_pass" class="input_03"  size="20">
																	</td>
																</tr>
															</table></td>
													</tr>
												</table></td>
										</tr>
									</table></td>
							</tr>
							<tr>
								<td><img src="../image/helpdesk/view_table_bottom.gif" width="680" height="10"></td>
							</tr>
						</table>
						<!--비밀번호입력 End-->
						<!--버튼-->
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="50" align="center">
								<input type='image' onfocus='blur();' src="../image/helpdesk/bu_ok.gif" width="70" height="30" align="absmiddle" border="0">
								<a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>"><img src="../image/helpdesk/bu_list.gif" width="80" height="30" border="0" align="absmiddle"></a>
								</td>
							</tr>
						</table>
						<!--버튼 End -->
           
            </td>
          </tr>
          </form>
          <script>
          document.f.user_pass.focus();
          </script>
</table>
<?
}else{
?>
					<table width="680" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10"><img src="../image/helpdesk/table1_left.gif" width="10" height="40"></td>
							<td width="60" align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/subject.gif" width="20" height="40"></td>
							<td width="1"><img src="../image/helpdesk/table1_line.gif" width="1" height="40"></td>
							<td background="../image/helpdesk/table1_bg.gif"> &nbsp;&nbsp;<?=$subject_new?></td>
							<td width="10"><img src="../image/helpdesk/table1_right.gif" width="10" height="40"></td>
						</tr>
</table>

					<table width="680" align="center"  border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="70" height="30" align="center"><img src="../image/helpdesk/view_writer.gif" width="60" height="30"></td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><?=$member_img?></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td width="70" height="30" align="center"><img src="../image/helpdesk/view_email.gif" width="40" height="30"></td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><?=$email?></td>
						</tr>
		<?
		if($bbs_no != 8){
		?>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_date.gif" width="40" height="30"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td class="point"><?=$write_date_str?></td>
						</tr>
		<?
		}
		?>
						
						
<? 
	if( $userfile || $userfile1 ){ 
?>
						
						<tr>
							<td height="30" align="center"><img src="../image/helpdesk/view_file.gif"></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td>
<? 
		if( $userfile ){ 
?>
								<a href='<?=$target?>' target="_blank"><?=$userfile?></a> (<?=$size?>)&nbsp;
<?
		}
?>
<? 
		if( $userfile1 ){ 
?>
								<a href='<?=$target1?>' target="_blank"><?=$userfile1?></a> (<?=$size1?>)&nbsp;
<?
		}
?>
							</td>
						</tr>
<?
	}
?>
</table>
					<table width="680" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><img src="../image/helpdesk/view_table_top.gif" width="680" height="10"></td>
						</tr>
<?
	if( $img_file ){
?>
						<tr>
							<td align="center" background="../image/helpdesk/view_table_bg.gif"><a href='#1' onClick="window.open('big.html?file=<?=$userfile?>&mart_id=<?=$mart_id?>','원본사진보기','width=<?=$img_width?>,height=<?=$img_height?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file?></a></td>
						</tr>
<?
	}
?>
<?
	if( $img_file1 ){
?>
						<tr height='10'>
							<td></td>
						</tr>
						<tr>
							<td align="center" background="../image/helpdesk/view_table_bg.gif"><a href='#1' onClick="window.open('big.html?file=<?=$userfile1?>&mart_id=<?=$mart_id?>','원본사진보기','width=<?=$img_width1?>,height=<?=$img_height1?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file1?></a></td>
						</tr>
<?
	}
?>
						<tr>
							<td background="../image/helpdesk/view_table_bg.gif">
								<table width="100%"  border="0" cellspacing="0" cellpadding="10">
									<tr>
										<td height="250" valign="top"><p align='justify'><?=$content?></p></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><img src="../image/helpdesk/view_table_bottom.gif" width="680" height="10"></td>
						</tr>
</table>
<?
	$SQL = "select index_no from $New_BoardTable where bbs_no = '$bbs_no' and mart_id = '$mart_id' and ansno > $ansno order by ansno limit 1";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if(mysql_num_rows($dbresult)>=1)
	$prevno = mysql_result($dbresult, 0,0);
	
	$SQL = "select index_no from $New_BoardTable where bbs_no = '$bbs_no' and mart_id = '$mart_id' and ansno < $ansno order by ansno desc limit 1";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if(mysql_num_rows($dbresult)>=1)
	$nextno = mysql_result($dbresult, 0,0);
?>
					<table width="680" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50">
								<?=$mod_perm?><?=$del_perm?>
								<?if($ary[notice_no] < '10000' ){?>
								<a href='board_reply.php?item_no=<?=$item_no?>&mart_id=<?=$mart_id?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src="../image/helpdesk/bu_reply.gif" width="70" height="30" border="0"></a>
								<?}?>
							</td>
							<td align="right"><a href='board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src="../image/helpdesk/bu_list.gif" width="80" height="30" border="0"></a></td>
						</tr>
</table>


<!------------------------- 덧글 시작 ----------------------------------------->
<?
	if( $comment_ok =="y" ){
		$sql1 = "select * from board_comment where bbs_no = '$bbs_no' and mart_id = '$mart_id' and index_no = '$index_no'  order by c_no asc"; 
		$dbresult1 = mysql_query($sql1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);
?>
					<table width="89%"  border="0" align="center" cellpadding="0" cellspacing="0">
<?
		for ($i=0; $i < $numRows1; $i++){
			$ary1 = mysql_fetch_array($dbresult1);
			$c_no = $ary1["c_no"];
			$c_name = $ary1["c_name"];
			$user_id = $ary1["user_id"];
			$c_regdate = $ary1["c_regdate"];
			$c_comment = $ary1["c_comment"];
			$c_comment = stripslashes($c_comment);
			$c_comment = htmlspecialchars($c_comment);	
			$c_comment = nl2br($c_comment);
	$c_comment = str_replace("아토피","***",$c_comment);
	$c_comment = str_replace("여드름","***",$c_comment);
	$c_comment = str_replace("기미","**",$c_comment);
	$c_comment = str_replace("주근깨","***",$c_comment);
	$c_comment = str_replace("주근께","***",$c_comment);
	$c_comment = str_replace("미백","**",$c_comment);
	$c_comment = str_replace("주름","**",$c_comment);
	$c_comment = str_replace("자외선차단","*****",$c_comment);
	$c_comment = str_replace("자외선 차단","*****",$c_comment);
?>
              			<tr>
                			<td  colspan="2" align="center">
								<table width='100%' border='0' cellspacing='0' cellpadding='5'>
									<tr bgcolor='#e7e7e7'> 
										<td height='1' colspan='3'></td>
									</tr>
									<tr>
                			<td bgColor="#FFFFFF" height="10" colspan="2"></td>
             			</tr>
									<tr valign='top'>
										<td width='10%'><b><?=$c_name?></b></td>
										<td width='80%'><?=$c_comment?> <span class="point">[ <?=$c_regdate?> ]</span></font>
										</td>
										<td width='10%' align="right"><a onfocus='blur()' style='cursor:hand' onClick="window.open('comment_check.php?flag=comdel&c_no=<?=$c_no?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>','비밀번호확인','width=450,height=300,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')"><img src='../image/helpdesk/bu_del.gif' border='0'></a></td>
									</tr>
								</table> 
                			</td>
              			</tr>
<?
		}
?>
              			<tr>
                			<td bgColor="#FFFFFF" height="10" colspan="2"></td>
              			</tr>
<SCRIPT LANGUAGE="JavaScript">
<!--
function form_comment_check(){
	var f = document.form_comment;

	if(f.cmt_name.value == ""){
		alert("이름을 입력 해주세요!!");
		f.cmt_name.focus();
		return false;
	}else if(f.cmt_password.value == ""){
		alert("비밀번호 입력 해주세요!!");
		f.cmt_password.focus();
		return false;
	}else if(f.cmt_comment.value == ""){
		alert("내용을 입력 해주세요!!");
		f.cmt_comment.focus();
		return false;
	}else{
		return true;
	}
}
//-->
</SCRIPT>
<!-- 코멘트 폼 -->
<form name='form_comment' method='post' action='comment_del.php' onsubmit="return form_comment_check()">
<input type="Hidden" name="flag" value="comment">
<input type="Hidden" name="mart_id" value="<?=$mart_id?>">
<input type="Hidden" name="bbs_no" value="<?=$bbs_no?>">
<input type="Hidden" name="index_no" value="<?=$index_no?>">
<input type="Hidden" name="page" value="<?=$page?>">
<input type="Hidden" name="keyset" value="<?=$keyset?>">
<input type="Hidden" name="searchword" value="<?=$searchword?>">
              			<tr>
                			<td bgColor="#FFFFFF" height="10" colspan="2"></td>
              			</tr>
              			<tr>
							<td>


					<!--덧글작성-->
				<table width="89%" align="center" border="0" cellspacing="0" cellpadding="0">
            	<tr>
            		<td><img src="../image/helpdesk/table3_top.gif" width="680" height="10"></td>
           		</tr>
            	<tr>
            		<td background="../image/helpdesk/table3_bg.gif"><table width="680"  border="0" align="center" cellpadding="0" cellspacing="0">
                	<tr>
                		<td width="50" height="30"><div align="center"><img src="../image/helpdesk/add_name.gif" width="34" height="20"></div></td>
                		<td width="74"><input type=text name=cmt_name size=10 class="input_03" maxlength=20 value='<?=$MemberName?>' <?=$writer_readonly?>>
							</td>
                		<td width="60"><?if(!$Mall_Admin_ID&&$MemberLevel!=1){?><img src="../image/helpdesk/add_pass.gif" width="53" height="20"><?}?></td>
                		<td width="500"><?if(!$Mall_Admin_ID&&$MemberLevel!=1){?><input type=password name=cmt_password  size=12 class="input_03"><?}?>&nbsp;</td>
                	</tr>
                	</table>
            			<table width="680"  border="0" align="center" cellpadding="0" cellspacing="0">
                  	<tr>
                  		<td width="50"><div align="center"><img src="../image/helpdesk/add_contents.gif" width="35" height="20"></div></td>
                  		<td width="563">
								<textarea name=cmt_comment cols="83" rows="3" class="input_03"></textarea></td>
                 		  <td width="120" align="center">
							  <input type='image' onfocus='blur();' src="../image/helpdesk/bu_regist.gif" width="70" height="50" align="absmiddle" border="0">
							 </tr>
                 	</table></td>
           		</tr>
            	<tr>
            		<td><img src="../image/helpdesk/table3_bottom.gif" width="680" height="10"></td>
           		</tr>
            	</table>
					<!--덧글작성 End-->
					</td>
						</tr>
						</form>
</table>
<?
	}
?>
<!------------------------- 덧글 끝 ------------------------------------------->
<?
}
?>
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
mysql_close($dbconn);
?>