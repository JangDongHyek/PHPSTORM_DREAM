<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">
<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 설정 파일을 불러옴 =============================================
include "../../main.class";
?>
<?	

if($auth_yn ==  'y' || $auth_yn ==  'd'){
	
	$SQL = "update $New_BoardTable set open_auth='$auth_yn' where index_no = '$index_no' and bbs_no='$bbs_no' and mart_id='$mart_id'";
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
$bubun = $ary[bubun];
$price = $ary[price];
$danwi = $ary[danwi];
$goyu_num = $ary[goyu_num];

$address = $ary[address];
$address2 = $ary[address2];
$tel = $ary[tel];
$hobby = $ary[hobby];
$email = $ary[email];

$my_bank_name = $ary[my_bank_name];
$my_bank_account = $ary[my_bank_account];
$my_bank_master = $ary[my_bank_master];




$open_address = $ary[open_address];
$open_address2 = $ary[open_address2];
$open_tel = $ary[open_tel];
$open_hobby = $ary[open_hobby];
$open_email = $ary[open_email];
$open_bank  = $ary[open_bank];

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
		$del_perm = "<img src='../image/helpdesk/bu_delete.gif' width='70' height='30' border='0' style='cursor:hand' onclick='delcheck($bbs_no)'>";
	}elseif($MemberLevel==2){
		$mod_perm = "<a href='board_edit.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_modify.gif' width='70' height='30' border='0'></a>";
	}
}else{
	if( $Mall_Admin_ID&&$MemberLevel==10){
		$mod_perm = "<a href='board_edit.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_modify.gif' width='70' height='30' border='0'></a>";
		$del_perm = "<img src='../image/helpdesk/bu_delete.gif' width='70' height='30' border='0' style='cursor:hand' onclick='delcheck($bbs_no)'>";
	}
}
?>
								<?
								if($_SESSION["MemberLevel"] == 4){ //회원만
									if($username != $_SESSION[Mall_Admin_ID]){ //자기글은 신청안되게
								?>
								<div align=center style="cursor:hand;" onclick="javascript:window.open('./offer.php?bbs_no=<?=$bbs_no?>&index_no=<?=$index_no?>','','width=500,height=550,top=100,left=200');"><b>[구매 및 신청 요청]</b></div>
								<?
									}
								}
								?>


































<div class="form">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="box2">
 
    <tr>
      <td align=center width=15% class="title">정보구분</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
			<?

			if($ary[jungbo_gubun] == "sell"){
				echo"판매정보";
			}elseif($ary[jungbo_gubun] == "buy"){
				echo"구입정보";
			}elseif($ary[jungbo_gubun] == "gujik"){
				echo"구직정보";
			}else{
				echo"구인정보";
			}

			?>
		</td>
    </tr>
    <tr>
      <td align=center width=15% class="title">분야</td> 
      <td width=35% bgcolor="#FFFFFF">
		<?
		$sql2 = "select category_name from jungbo_cate_bunya where seq_num='$ary[bunryu]'";
		$res2 = mysql_query($sql2,$dbconn);
		$row2 = mysql_fetch_array($res2);

		$bunryu_name = $row2[category_name];
		echo $bunryu_name;

		?>		
	  </td>
      <td align=center width=15% class="title">부분</td>
      <td width=35% bgcolor="#FFFFFF">
		<?
		$sql2 = "select category_name from jungbo_cate_bunya where seq_num='$ary[bubun]'";
		$res2 = mysql_query($sql2,$dbconn);
		$row2 = mysql_fetch_array($res2);

		$bubun_name = $row2[category_name];
		echo $bubun_name;

		?>	  </td>
    </tr>
	<tr>
      <td align=center class="title">단위</td> 
      <td bgcolor="#FFFFFF"><?=$ary[danwi]?></td>
      <td align=center class="title">금액</td>
      <td bgcolor="#FFFFFF"><?=number_format($ary[price])?>원</td>
    </tr>
	<tr>
      <td align=center class="title">게시기간</td> 
      <td bgcolor="#FFFFFF" colspan=3>
			<?=$ary[end_date]?> 까지
	  </td>

    </tr>

	<tr>
      <td align=center width=15% class="title">작성자</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3><?=$ary[writer]?></td>
    </tr>
<?
if($ary[open_num] == 'y'){	
?>
	<tr>
      <td align=center width=15% class="title">회원번호</td>
      <td width=85% bgcolor="#FFFFFF" colspan=3><?=$ary[goyu_num]?></td>
    </tr>
<?}?>
<?
if($ary[open_address] == 'y'){	
?>
	<tr>
      <td align=center width=15% class="title">주소</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
		<?=$ary[address]?>
							
								<?$addr = str_replace("부산시 진구","부산시 부산진구",$ary[address]);?>
								<font style='cursor:hand;' onclick="window.open('./map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[위치확인]</font>						
							
								  
	  </td>
    </tr>
<?}?>
<?
if($ary[open_address2] == 'y'){	
?>
	<tr>
      <td align=center width=15% class="title">거래용주소</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
	  <?=$ary[sea_area]?>

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
			<!--<?=$ary[address2]?>
							
								<?$addr = str_replace("부산시 진구","부산시 부산진구",$ary[address2]);?>
								<font style='cursor:hand;' onclick="window.open('./map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[위치확인]</font>-->
		</td>
    </tr>
<?}?>

<?
if($ary[open_tel] == 'y'){	
?>
	<tr>
      <td align=center width=15% class="title">전화번호</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3><?=$ary[tel]?></td>
    </tr>
<?}?>


<?
if($ary[open_bank] == 'y'){	
?>
	<tr>
      <td align=center width=15% class="title">계좌정보</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3><?=$ary[my_bank_name]?> <?=$ary[my_bank_account]?> (예금주:<?=$ary[my_bank_master]?>) </td>
    </tr>
<?}?>
	<tr>
      <td align=center width=15% class="title">내용</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
		<?=$content?>
	  </td>
    </tr>
	<?php
		$sql="select * from new_board_file where bbs_no='$bbs_no' and index_no='$index_no'";
		$fResult=mysql_query($sql);
		for($i=0;$fRow=mysql_fetch_array($fResult);$i++){
			$target = "$upload"."$fRow[file_name]";
			$encode_target = "$upload".rawurlencode("$fRow[file_name]");
			//========================= userfile =====================================================
			if( eregi("\.jpg", $fRow['file_name']) || eregi("\.gif", $fRow['file_name']) || eregi("\.JPG", $fRow['file_name']) || eregi("\.GIF", $fRow['file_name'])|| eregi("\.png", $fRow['file_name'])|| eregi("\.PNG", $fRow['file_name']) ){
				//==================== 이미지 사이즈를 구함 ==========================================
				$img_size = GetImageSize("$target"); 

				if( eregi("\.jpg", $fRow['file_name']) || eregi("\.gif", $fRow['file_name']) || eregi("\.JPG", $fRow['file_name']) || eregi("\.GIF", $fRow['file_name']) ){
					$img_width = $img_size[0]; //이미지의 넓이를 알 수 있음 
					$img_height = $img_size[1]; //이미지의 높이를 알 수 있음
				}

				//=============================== 가로,세로 비율에 맞게 이미지 맞추기 ================
				if( $fRow['file_name'] ){
					list( $height_new, $width_new ) = img_size( "$target", "600", "10000");
				}

				$img_file = "<img src='$encode_target' width='$width_new' height='$height_new' border='0' hspace='5' style='border: #000000; border-style: solid; border-width:1px'><br>".$img_file;
			}else if(eregi("\.swf", $fRow['file_name'])){
				$img_file = "<embed src='$encode_target' border='0'><br>".$img_file;
			}
	?>
	<tr>
		<td colspan="2" align="center">
			<a href='#<?php echo $i+1?>' onClick="window.open('big.html?file=<?=$fRow[file_name]?>&mart_id=<?=$mart_id?>','원본사진보기','width=<?=$img_width?>,height=<?=$img_height?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file?></a>
		</td>
	</tr>
	<?php $img_file="";}?>

<?
	/*if( $img_file ){
?>
	<tr>
      <td align=center width=15% class="title">첨부파일1</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
		<a href='#1' onClick="window.open('big.html?file=<?=$ary[userfile]?>&mart_id=<?=$mart_id?>','원본사진보기','width=<?=$img_width?>,height=<?=$img_height?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file?></a>
	  </td>
    </tr>	
<?
	}
?>
<?
	if( $img_file1 ){
?>
	<tr>
      <td align=center width=15% class="title">첨부파일1</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
		<a href='#1' onClick="window.open('big.html?file=<?=$ary[userfile1]?>&mart_id=<?=$mart_id?>','원본사진보기','width=<?=$img_width1?>,height=<?=$img_height1?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file1?></a>
	  </td>
    </tr>

<?
	}*/
?>
</table>
</div>
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
					<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50">
				

								<?=$mod_perm?><?=$del_perm?>
								
								<!--<a href='board_reply.php?mart_id=<?=$mart_id?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src="../image/helpdesk/bu_reply.gif" width="70" height="30" border="0"></a>-->
							</td>
							<td align="right">
							<?
							/*
							if(($_SESSION["MemberLevel"] == 3 && $open_auth == "n") || ($_SESSION["MemberLevel"] == 10 && $open_auth == "n") ){
							?>
							<a href='board_read.php?auth_yn=y&index_no=<?=$index_no?>&mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src="../images/board/approval_butten.gif" border=0></A>
							&nbsp;&nbsp;
							<a href='board_read.php?auth_yn=d&index_no=<?=$index_no?>&mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src="../images/board/approval_butten_2.jpg" border=0></A>

							<?}
							*/
							?>



							<?
							//자기글일때 수정요청,삭제요청	
							if($username == $_SESSION[Mall_Admin_ID]){
							?>
								<span style="cursor:hand;" onclick="javascript:window.open('./request_update.php?bbs_no=<?=$bbs_no?>&index_no=<?=$index_no?>','','width=500,height=500,top=100,left=200');"><img src="../images/board/modify_butten.gif" border=0></span>
								
								<span style="cursor:hand;" onclick="javascript:window.open('./request_delete.php?flag=insert&bbs_no=<?=$bbs_no?>&index_no=<?=$index_no?>','','width=1,height=1,top=100,left=200');"><img src="../images/board/butten_del.gif" border=0></span>
							<?
							}else if($_SESSION[Admin_type]=="jsell" && $_SESSION[Admin_level]=="3"){
							?>
								<span style="cursor:hand;" onclick="javascript:window.open('./request_update.php?bbs_no=<?=$bbs_no?>&index_no=<?=$index_no?>','','width=500,height=500,top=100,left=200');"><img src="../images/board/modify_butten.gif" border=0></span>
								
								
								<span style="cursor:hand;" onclick="javascript:window.open('./request_delete.php?flag=insert&bbs_no=<?=$bbs_no?>&index_no=<?=$index_no?>','','width=1,height=1,top=100,left=200');"><img src="../images/board/butten_del.gif" border=0></span>
							<?}?>
				<?
				/*
					if($ary[chungjun_take] == 'y'){
				?>
					<b>[거래완료]</b>
				<?}else{?>
							<a href="./board_read.php?jungbo_price=y&goyu_num=<?=$goyu_num?>&price=<?=$ary[price]?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=khj&bubun_name=<?=$bubun_name?>">[충전금 보내기]</a>
				<?}
				*/
				?>




<script>
            function question(v1,v2,v3,v4,v5,v6) {
                sub = confirm("충전금을 보내시겠습니까?")
                if (sub == true) {
                  location.href='./board_read.php?jungbo_price=y&mart_id=khj&goyu_num='+v1+'&price='+v2+'&index_no='+v3+'&bbs_no='+v4+'&page='+v5+'&bubun_name='+v6;
                } 
            }
        </script>









						<a href="#" onclick="question('<?=$goyu_num?>','<?=$ary[price]?>','<?=$index_no?>','<?=$bbs_no?>','<?=$page?>','<?=$bubun_name?>');">[충전금 보내기]</a>





				&nbsp;&nbsp;

							<a href='board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&my_list=<?=$my_list?>'><img src="../image/helpdesk/bu_list.gif" border="0"></a>
							

							
							
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
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
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




if($jungbo_price == "y"){


			$write_date = date("YmdHis");
			$price = str_replace(",","",$price);

			$query = "select * from $ItemTable where item_id ='$_SESSION[Mall_Admin_ID]'";
			$result = mysql_query( $query, $dbconn );
			$row = mysql_fetch_array( $result );



			$mem_num = $row[sea_num].$row[sung_num].$row[khan_num].$row[sudong_num];
			$sum_sql = "select sum(bonus) as bonus_total from $BonusTable where mart_id ='$mart_id' and id='$mem_num'";
			$sum_rs = mysql_query($sum_sql, $dbconn);
			$sum_rows = mysql_fetch_array($sum_rs);
			$bonus_total_str = $sum_rows[bonus_total];

			if($bonus_total_str < $price){
				echo("
					<script>
					alert('충전금이 부족합니다.');
					</script>
					<meta http-equiv='Refresh' content='0; URL=board_read.php?mart_id=$mart_id&bbs_no=$bbs_no&index_no=$index_no'>
				");
				exit;
			}else{

				
			
				
				//받는사람저장
				$content = $row[sea_num].$row[sung_num].$row[khan_num].$row[sudong_num]."님이 보낸 충전금"."(품명:".$bubun_name.")";
				$mode = "ug";
				$id = $goyu_num;
			
				$SQL = "insert into $BonusTable (mart_id, bonsa_id, id, write_date, bonus, content, mode, bbs_no, index_no)  values ('$mart_id', '$bonsa_id', '$id', '$write_date', '$price', '$content', '$mode','$bbs_no','$index_no')";



				$dbresult = mysql_query($SQL, $dbconn);


				//보낸사람저장
				$content = $goyu_num."님께 충전금 보냄"."(품명:".$bubun_name.")";
				
				$mode = "us";
				$id=$row[sea_num].$row[sung_num].$row[khan_num].$row[sudong_num];

				$SQL = "insert into $BonusTable (mart_id, bonsa_id, id, write_date, bonus, content, mode) values ('$mart_id', '$bonsa_id', '$id', '$write_date', '-$price', '$content', '$mode')";
				$dbresult = mysql_query($SQL, $dbconn);


				$sql = "update new_board set chungjun_take='y' where index_no='$index_no'";
				$res = mysql_query($sql,$dbconn);

				echo("
					<script>
					alert('$goyu_num 님께 충전금 $price 원을 보냈습니다.');
					</script>
					<meta http-equiv='Refresh' content='0; URL=board_read.php?mart_id=$mart_id&bbs_no=$bbs_no&index_no=$index_no'>
				");
				exit;
			}
}

















mysql_close($dbconn);
?>
