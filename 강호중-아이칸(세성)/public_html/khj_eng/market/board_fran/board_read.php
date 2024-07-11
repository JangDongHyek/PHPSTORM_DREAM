<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 설정 파일을 불러옴 =============================================
include "../../main.class";
?>
<?	

if($auth_yn ==  'y'){
	
	$SQL = "update $New_BoardTable set open_auth='y' where index_no = '$index_no' and bbs_no='$bbs_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

}


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
			parent.location.href='../member/login.html?url=$url&mart_id=$mart_id';
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
	//include "$top_body";
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
$content = $ary[content];
$if_secret = $ary[if_secret];
$userfile = $ary[userfile];
$userfile1 = $ary[userfile1];
$open_auth = $ary[open_auth];
$bunryu = $ary[bunryu];


$address = $ary[address];
$tel = $ary[tel];
$hobby = $ary[hobby];
$email = $ary[email];

$my_bank_name = $ary[my_bank_name];
$my_bank_account = $ary[my_bank_account];
$my_bank_master = $ary[my_bank_master];




$open_address = $ary[open_address];
$open_tel = $ary[open_tel];
$open_hobby = $ary[open_hobby];
$open_email = $ary[open_email];
$open_bank  = $ary[open_bank];
$halin  = $ary[halin];

$end_date = $ary[end_date];

$subject_new = eregi_replace( "\'", "'", $subject_new );
$content = eregi_replace( "\'", "'", $content );

$content = get_link($content);

//========================= 이미지 태그내의 스크립트 방지 ================================
$src = "/<img .*src=[a-z0-9\"']*script:[^>]+>/i";
$des = "";
$content = preg_replace($src, $des, $content);
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
		list( $height_new, $width_new ) = img_size( "$target", "600", "10000");
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
		list( $height_new1, $width_new1 ) = img_size( "$target1", "600", "10000");
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

if($bbs_no == 4){
	if($MemberLevel==1){
		//$del_perm = "<img src='../image/helpdesk/bu_delete.gif' width='70' height='30' border='0' style='cursor:hand' onclick='delcheck($bbs_no)'>";
	}elseif($MemberLevel==2){
		//$mod_perm = "<a href='board_edit.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_modify.gif' width='70' height='30' border='0'></a>";
	}
}else{
	if( $Mall_Admin_ID&&$MemberLevel==10){
	//	$mod_perm = "<a href='board_edit.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_modify.gif' width='70' height='30' border='0'></a>";
	//	$del_perm = "<img src='../image/helpdesk/bu_delete.gif' width='70' height='30' border='0' style='cursor:hand' onclick='delcheck($bbs_no)'>";
	}
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
								<td align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/pass_type.gif"></td>
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
								<a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>"><img src="../image/helpdesk/bu_list.gif" border="0" align="absmiddle"></a>
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
			
				
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0" class="box2">
 
    <tr>
      <td align=center width=25% class="title">분야</td> 
      <td width=25% bgcolor="#FFFFFF">
		<?
		$sql2 = "select category_name from gameng_cate_bunya where seq_num='$ary[bunryu]'";
		$res2 = mysql_query($sql2,$dbconn);
		$row2 = mysql_fetch_array($res2);

		$bunryu_name = $row2[category_name];
		echo $bunryu_name;

		?>		


		<?=$row5[category_name]?>	  </td>
      <td align=center width=25% class="title">부분</td>
      <td width=25% bgcolor="#FFFFFF">
			<?
		$sql2 = "select category_name from gameng_cate_bunya where seq_num='$ary[bubun]'";
		$res2 = mysql_query($sql2,$dbconn);
		$row2 = mysql_fetch_array($res2);

		$bubun_name = $row2[category_name];
		echo $bubun_name;

		?>	  </td>
    </tr>


	<tr>
      <td align=center width=25% class="title">상호</td> 
      <td width=75% bgcolor="#FFFFFF" colspan=3><?=$ary[subject_new]?>
	  
	  </td>
    </tr>

	<tr>
      <td align=center width=25% class="title">할인율</td> 
      <td width=75% bgcolor="#FFFFFF" colspan=3><?=$halin?>%</td>
    </tr>				
				
	<tr>
      <td align=center width=25% class="title">작성자</td> 
      <td width=75% bgcolor="#FFFFFF" colspan=3><?=$member_img?>
							
	</td>
    </tr>


	<tr>
      <td align=center width=25% class="title">회원번호</td> 
      <td width=75% bgcolor="#FFFFFF" colspan=3>

  <?
//if($_SESSION["MemberLevel"] == 10){
	$sql5 = "select * from category where g_id='$username'";
	$res5 = mysql_query($sql5,$dbconn);
	$row5 = mysql_fetch_array($res5);

	echo $row5[country_num].$row5[sea_num].$row5[sung_num].$row5[khan_num];
//}
?>

							
	</td>
    </tr>


	<tr>
      <td align=center width=25% class="title">지역</td> 
      <td width=75% bgcolor="#FFFFFF" colspan=3>
	  
	  <?=$ary[sea_area]?>
	   <?=$ary[sung_area]?>
	    <?=$ary[khan_area]?>
<!--
	  <?
	$sql6 = "select * from category where category_degree='1' and sung_num='$ary[sung_area]'";
	$res6 = mysql_query($sql6,$dbconn);
	$row6 = mysql_fetch_array($res6);
	  echo $row6[sung_area];
	  ?>
	  

	  <?
	$sql6 = "select * from category where category_degree='2' and khan_num='$ary[khan_area]'";
	$res6 = mysql_query($sql6,$dbconn);
	$row6 = mysql_fetch_array($res6);
	  echo $row6[khan_area];
	  ?>	  
-->	  
	 <!-- <?=$address?>
								<?$addr = str_replace("부산시 진구","부산시 부산진구",$address);?>
								<font style='cursor:hand;' onclick="window.open('./map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[위치확인]</font>	-->	</td>
    </tr>

	<tr>
      <td align=center width=25% class="title">연락처</td> 
      <td width=75% bgcolor="#FFFFFF" colspan=3><?=$tel?></td>
    </tr>	





	<tr>
      <td align=center width=25% class="title">주소</td> 
      <td width=75% bgcolor="#FFFFFF" colspan=3><?=$address?>
	  <?$addr = str_replace("부산시 진구","부산시 부산진구",$address);?>
								<font style='cursor:hand;' onclick="window.open('./map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[위치확인]</font>
	  </td>
    </tr>	








		<?
		if($bbs_no != 8){
		?>
						<tr>
						  <td align=center width=25% class="title">등록일</td> 
						  <td width=75% bgcolor="#FFFFFF" colspan=3><?=$write_date_str?></td>
						</tr>
		<?
		}
		?>
						<tr>
						  <td align=center width=25% class="title">조회수</td> 
						  <td width=75% bgcolor="#FFFFFF" colspan=3><?=$read_num?></td>
						</tr>
						
						<tr>
						  <td align=center width=25% class="title">게시기간</td> 
						  <td width=75% bgcolor="#FFFFFF" colspan=3><?=$end_date?> 까지</td>
						</tr>
<? 
		if( $userfile ){ 
?>

						<tr>
						  <td align=center width=25% class="title">사진1</td> 
						  <td width=75% bgcolor="#FFFFFF" colspan=3><a href='<?=$target?>' target="_blank"><?=$userfile?></a> (<?=$size?>)&nbsp;</td>
						</tr>	
<?
		}
?>
<? 
		if( $userfile1 ){ 
?>

						<tr>
						  <td align=center width=25% class="title">사진1</td> 
						  <td width=75% bgcolor="#FFFFFF" colspan=3><a href='<?=$target1?>' target="_blank"><?=$userfile1?></a> (<?=$size1?>)&nbsp;</td>
						</tr>	
<?
		}
?>


						<tr>
						  <td align=center width=25% class="title">내용</td> 
						  <td width=75% bgcolor="#FFFFFF" colspan=3>
						  
						  
<?
	if( $img_file ){
?>					  
<a href='#1' onClick="window.open('big.html?file=<?=$userfile?>&mart_id=<?=$mart_id?>','원본사진보기','width=<?=$img_width?>,height=<?=$img_height?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file?></a>						  
<?
	}
?>
<?
	if( $img_file1 ){
?>	
<a href='#1' onClick="window.open('big.html?file=<?=$userfile1?>&mart_id=<?=$mart_id?>','원본사진보기','width=<?=$img_width1?>,height=<?=$img_height1?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file1?></a>
<?
	}
?>	

<br>

<?=$content?>
						  </td>
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

								<?=$mod_perm?><?=$del_perm?><!--<a href='board_reply.php?mart_id=<?=$mart_id?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src="../image/helpdesk/bu_reply.gif" width="70" height="30" border="0"></a>-->
							</td>
							<td align="right">
							<?
							if($_SESSION["MemberLevel"] == 3 && $open_auth == "n"){
							/*
							?>
							<a href='board_read.php?auth_yn=y&index_no=<?=$index_no?>&mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src="../images/board/approval_butten.gif" border=0></A>
							<?
							*/
							}
							?>



							<?
							//가맹점 게시판은 칸 본인만 수정,삭제요청
							if($username == $_SESSION[Mall_Admin_ID]){
							?>
								<span style="cursor:hand;" onclick="javascript:window.open('./request_update.php?bbs_no=<?=$bbs_no?>&index_no=<?=$index_no?>','','width=500,height=500,top=100,left=200');"><img src="../image/helpdesk/btn_modify2.gif" border=0></span>
								
								<span style="cursor:hand;" onclick="javascript:window.open('./request_delete.php?flag=insert&bbs_no=<?=$bbs_no?>&index_no=<?=$index_no?>','','width=1,height=1,top=100,left=200');"><img src="../image/helpdesk/btn_delete2.gif" border=0></span>
							<?
							}
							?>


							<a href='board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&my_list=<?=$my_list?>'><img src="../image/helpdesk/bu_list3.gif"  border="0"></a>
							
							
							
							
							</td>
						</tr>
</table>


<!------------------------- 구매 및 신청 리스트 ----------------------------------------->
<?
	if( $username == $_SESSION[Mall_Admin_ID] ){
		$sql1 = "select * from offer where index_no = '$index_no'"; 
		$dbresult1 = mysql_query($sql1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);
?>
				<table width="680"  border="0" align="center" cellpadding="0" cellspacing="0">
<?
		for ($i=0; $i < $numRows1; $i++){
			$ary1 = mysql_fetch_array($dbresult1);

			$sql = "select * from item where item_id='$ary1[item_no]'";

			$result = mysql_query($sql,$dbconn);
			$rows = mysql_fetch_array($result);

			$c_regdate = $ary1["regdate"];
			$c_comment = $ary1["content"];
			$c_comment = stripslashes($c_comment);
			$c_comment = htmlspecialchars($c_comment);	
			$c_comment = nl2br($c_comment);
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
										<td width='10%'><span style="cursor:hand;" onclick="javascript:window.open('./offer_detail.php?seq_num=<?=$ary1[seq_num]?>&username=<?=$username?>','','width=500,height=500,top=100,left=200,scrollbars=yes');">
										<?if($ary1[state]=='y'){?>
										<font color=blue>
										<?}?>
										<?if($ary1[misu]=='y'){?>
										<font color=red>
										<?}?>	
										<b><?=$rows[item_name]?></b>
										</font>

										</span></td>
										<td width='70%'><?=$c_comment?> </font>
										</td>
										<td width='20%' align="right">
										<span class="point">[ <?=$c_regdate?> ]</span>
										</td>
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
	//include "$bottom_body";
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
